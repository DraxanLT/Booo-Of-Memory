<?php
include('database.php');
$db = connectToDbAndGetPdo();

session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['email']) && isset($_POST['pseudonyme']) && isset($_POST['motdepasse']) && isset($_POST['confirmmotdepasse'])) {
        $email = $_POST['email'];
        $pseudo = $_POST['pseudonyme'];
        $motdepasse = $_POST['motdepasse'];
        $confirmation = $_POST['confirmmotdepasse'];

        if ($motdepasse !== $confirmation) {
            $_SESSION['erreur'] = "Les mots de passe ne correspondent pas.";
            header('Location: /register.php');
            exit();
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/', $motdepasse)) {
            $_SESSION['erreur'] = "Le mot de passe doit comporter au moins 8 caractères, incluant une majuscule, une minuscule, un chiffre et un caractère spécial.";
            header('Location: /register.php');
            exit();
        }

        $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['erreur'] = "Cet email est déjà utilisé.";
            header('Location: /register.php');
            exit();
        }

        $motdepasse_hash = hash('sha256', $motdepasse); 
        $date = date('Y-m-d H:i:s');

        try {
            $stmt = $db->prepare("INSERT INTO utilisateur (email, pseudo, mot_de_passe, date_heure_inscription) VALUES (:email, :pseudo, :motdepasse, :inscription)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':motdepasse', $motdepasse_hash);
            $stmt->bindParam(':inscription', $date);

            if ($stmt->execute()) {
                header('Location: /login.php');
                exit();
            } else {
                $_SESSION['erreur'] = "Une erreur est survenue lors de l'inscription.";
                header('Location: /register.php');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['erreur'] = "Erreur de connexion à la base de données : " . $e->getMessage();
            header('Location: /register.php');
            exit();
        }
    } else {
        $_SESSION['erreur'] = "Tous les champs sont requis.";
        header('Location: /register.php');
        exit();
    }
}

$db = null;
?>
