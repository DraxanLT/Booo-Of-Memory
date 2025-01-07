<?php
include('database.php');
$db = connectToDbAndGetPdo();

session_start();
$error = '';
$good = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
        header('Location: /contact.php');
        exit();
    }

    $request = $db->prepare("
        INSERT INTO contact_message (name, email, subject, message, date_time_message_send)
        VALUES (:name, :email, :subject, :message, NOW())
    ");
    $request->bindParam(':name', $name);
    $request->bindParam(':email', $email);
    $request->bindParam(':subject', $subject);
    $request->bindParam(':message', $message);

    if ($request->execute()) {
        $_SESSION['good'] = "Votre message a été envoyé avec succès !";
        header('Location: /contact.php');
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de l'enregistrement du message.";
        header('Location: /contact.php');
        exit();
    }

} else {
    $_SESSION['error'] = "Tous les champs sont requis.";
    header('Location: /contact.php');
    exit();
}

$db = null;
?>
