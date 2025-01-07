<?php
session_start();
$error = '';
$good = '';

include('database.php');
$db = connectToDbAndGetPdo();

$joueur_id = $_SESSION['userId'];

$stmt = $db->prepare("SELECT type, data FROM images_users WHERE joueur_id = ?");
$stmt->execute([$joueur_id]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if ($image) {
    header("Content-Type: " . $image['type']);
    echo $image['data'];
} else {
    $defaultImagePath = '../assets/main/nopicture.png';

    if (file_exists($defaultImagePath)) {
        header("Content-Type: image/png");
        echo file_get_contents($defaultImagePath);
    } else {
        echo "Image non trouvée et image par défaut introuvable.";
    }
}

$db = null;
?>
