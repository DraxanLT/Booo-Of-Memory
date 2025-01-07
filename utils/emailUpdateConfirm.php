<?php
include('database.php');
$db = connectToDbAndGetPdo();
session_start();
$error = '';  
$good = '';  

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['old_email']) && isset($_POST['new_email']) && isset($_POST['password'])) {
        $old_email = $_POST['old_email'];
        $new_email = $_POST['new_email'];
        $motdepasse = $_POST['password'];
        
        $motdepasse_hash = hash('sha256', $motdepasse);
        $id = $_SESSION['userId'];

        $stmt = $db->prepare("SELECT email, mot_de_passe FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['email'] === $old_email && $motdepasse_hash === $user['mot_de_passe']) {
                $stmt = $db->prepare("UPDATE utilisateur SET email = :new_email WHERE id = :id");
                $stmt->bindParam(':new_email', $new_email);
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $_SESSION['good'] = "L'adresse e-mail a été mise à jour avec succès.";
                header('Location: /profil.php');
                exit();
            } else {
                $_SESSION['error'] = "L'ancienne adresse e-mail ou le mot de passe est incorrect.";
                header('Location: /profil.php');
                exit();
            }
        } else {
            $_SESSION['error'] = "Utilisateur non trouvé.";
            header('Location: /profil.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header('Location: /profil.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Méthode de requête non valide.";
    header('Location: /profil.php');
    exit();
}

$db = null;
?>
