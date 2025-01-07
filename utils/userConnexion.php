<?php
include('database.php');
$db = connectToDbAndGetPdo();

session_start();
$error = '';
$good = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $motdepasse = $_POST['password'];
    $motdepasse_hash = hash('sha256', $motdepasse);

    $request = $db->prepare("SELECT id, mot_de_passe FROM utilisateur WHERE email = :email");
    $request->bindParam(':email', $email);
    $request->execute();
    $user = $request->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($motdepasse_hash === $user['mot_de_passe']) {

            $_SESSION['userId'] = $user['id'];
            $request = $db->prepare("UPDATE utilisateur SET date_heure_d_connexion = NOW() WHERE id = :id ");
            $request->bindParam(':id', $user['id']);
            $request->execute();
            header('Location: /index.php');
            exit();
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
            header('Location: /login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Aucun compte trouvé avec cet email.";
        header('Location: /login.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Veuillez remplir tous les champs.";
    header('Location: /login.php');
    exit();
}
$db = null;
?>
