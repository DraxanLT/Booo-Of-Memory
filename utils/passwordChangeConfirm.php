<?php
include('database.php');
$db = connectToDbAndGetPdo();
session_start();
$error = '';
$good = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $password_regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/';

        $id = $_SESSION['userId'];

        $stmt = $db->prepare("SELECT mot_de_passe FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $old_password_hash = hash('sha256', $old_password);

            if ($old_password_hash === $user['mot_de_passe']) {
                if ($new_password === $confirm_password) {
                    if (preg_match($password_regex, $new_password)) {
                        $new_password_hash = hash('sha256', $new_password);

                        $stmt = $db->prepare("UPDATE utilisateur SET mot_de_passe = :new_password WHERE id = :id");
                        $stmt->bindParam(':new_password', $new_password_hash);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $_SESSION['good'] = "Le mot de passe a été mis à jour avec succès.";
                        header('Location: /profil.php');
                        exit();
                    } else {
                        $_SESSION['error'] = "Le nouveau mot de passe doit contenir au moins 8 caractères, incluant une majuscule, une minuscule, un chiffre et un caractère spécial.";
                        header('Location: /profil.php');
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "La confirmation du nouveau mot de passe ne correspond pas.";
                    header('Location: /profil.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = "L'ancien mot de passe est incorrect.";
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
