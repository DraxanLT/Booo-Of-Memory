<?php
    include('database.php');
    $db = connectToDbAndGetPdo();

    session_start();
    $error = '';
    $good = '';
    $name='';
    $bio='';
    $date=
 
    $joueur_id = $_SESSION['userId'];

    
    $stmt = $db->prepare("SELECT pseudo, bio, date_heure_inscription FROM utilisateur WHERE id = ?");
    $stmt->execute([$joueur_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($utilisateur) {
        $pseudo = $utilisateur['pseudo'];
        $bio = $utilisateur['bio'];
        $date_inscription = $utilisateur['date_heure_inscription'];
    
   
        echo "<p><strong>Nom d'utilisateur :</strong> " . htmlspecialchars($pseudo) . "</p>";
        echo "<p><strong>Bio :</strong> " . htmlspecialchars($bio) . "</p>";
        echo "<p><strong>Date d'inscription :</strong> " . htmlspecialchars($date_inscription) . "</p>";
    } else {
        echo "Utilisateur non trouvé.";
    }
    
    $db = null;
    ?>
    

    ?>