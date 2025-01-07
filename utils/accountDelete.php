<?php

include('database.php');
$db = connectToDbAndGetPdo();
session_start();
$error = '';
$good = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $deleteConfirmation = trim($_POST['delete']);

    if (strtolower($deleteConfirmation) === 'confirmer') {

        $id = $_SESSION['userId'];

        try {

            $db->beginTransaction();

            $query = "DELETE FROM message_prive WHERE p_joueur_id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $query = "DELETE FROM message_prive WHERE s_joueur_id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $query = "DELETE FROM chat WHERE joueur_id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $query = "DELETE FROM images_users WHERE joueur_id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $query = "DELETE FROM score WHERE joueur_id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $query = "DELETE FROM utilisateur WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([':id' => $id]);
            $stmt->closeCursor();

            $db->commit();

            header('Location: /index.php');
            exit();

        } catch (Exception $e) {

            $db->rollBack();
            $_SESSION['error'] = "Échec de la suppression : " . $e->getMessage();
            header('Location: /profil.php');
            exit();
        }
    } else {

        $_SESSION['error'] = "Veuillez entrer 'CONFIRMER' pour confirmer la suppression.";
        header('Location: /profil.php');
        exit();
    }
}
?>
