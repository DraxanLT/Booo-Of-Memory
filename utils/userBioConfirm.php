<?php
include('database.php');
$db = connectToDbAndGetPdo();
session_start();
$error = ''; 
$good = ''; 

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['pseudo']) && isset($_POST['bio'])) {
        $pseudo = $_POST['pseudo'];
        $bio = $_POST['bio'];
        $id = $_SESSION['userId'];

        $bannedWords = ['Mangeur2Caca', 'Ines', 'Caca', 'Pipi', 'Crotte', 'Pute', 'Salope', 'Connard', 'Enculé']; // Add more words if needed

        foreach ($bannedWords as $word) {
            if (stripos($pseudo, $word) !== false) {
                $_SESSION['error'] = "Le pseudo contient des mots inappropriés.";
                header('Location: /profil.php');
                exit();
            }
        }

        if (strlen($pseudo) < 4) {
            $_SESSION['error'] = "Le pseudo doit comporter au moins 4 caractères.";
            header('Location: /profil.php');
            exit();
        }

        $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE pseudo = :pseudo AND id != :id");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $_SESSION['error'] = "Le pseudo est déjà pris. Veuillez en choisir un autre.";
            header('Location: /profil.php');
            exit();
        }

        $stmt = $db->prepare("UPDATE utilisateur SET pseudo = :pseudo, bio = :bio WHERE id = :id");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $_SESSION['good'] = "Votre profil a été mis à jour avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour de votre profil.";
        }

        header('Location: /profil.php');
        exit();
    } else {
        $_SESSION['error'] = "Les champs 'pseudo' et 'bio' sont requis.";
        header('Location: /profil.php');
        exit();
    }
} else {
    $db = null;
}
?>
