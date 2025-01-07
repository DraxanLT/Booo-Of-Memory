<?php
session_start();
$error = '';
$good = '';

include('database.php');
$db = connectToDbAndGetPdo();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

    $taille_max = 5 * 1024 * 1024;

    if ($_FILES['image']['size'] > $taille_max) {
        $_SESSION['error'] = "L'image est trop grande. La taille maximale est de 5 Mo.";
        header('Location: /profil.php');
        exit();
    }

    $joueur_id = $_SESSION['userId'];
    $image_nom = $_FILES['image']['name'];
    $image_type = $_FILES['image']['type'];
    $image_data = file_get_contents($_FILES['image']['tmp_name']);

    try {
        $stmt = $db->prepare("SELECT COUNT(*) FROM images_users WHERE joueur_id = ?");
        $stmt->execute([$joueur_id]);
        $image_exists = $stmt->fetchColumn();

        if ($image_exists) {
            $stmt = $db->prepare("UPDATE images_users SET nom = ?, type = ?, data = ? WHERE joueur_id = ?");
            $stmt->execute([$image_nom, $image_type, $image_data, $joueur_id]);
            $_SESSION['good'] = "Image mise à jour avec succès !";
        } else {
            $stmt = $db->prepare("INSERT INTO images_users (nom, type, data, joueur_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$image_nom, $image_type, $image_data, $joueur_id]);
            $_SESSION['good'] = "Image téléchargée avec succès !";
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur lors de l'enregistrement de l'image. Veuillez réessayer avec une image de taille inférieure.";
        header('Location: /profil.php');
        exit();
    }

    header('Location: /profil.php');
    exit();
} else {
    $_SESSION['error'] = "Erreur lors du téléchargement de l'image ou session utilisateur non définie.";
    header('Location: /profil.php');
    exit();
}

$db = null;
?>
