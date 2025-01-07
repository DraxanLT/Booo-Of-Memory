<!DOCTYPE html>
<html lang="fr">

<?php $page = 'profile'; include __DIR__ . '/partials/head.php';?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
<link href="../assets/main.css" rel="stylesheet">
    <link href="../assets/header.css" rel="stylesheet">
    <link href="../assets/dstyles.css" rel="stylesheet">
    <link href="../assets/footer.css" rel="stylesheet">
    <link href="../assets/contact.css" rel="stylesheet">

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">Compte</h1>
        </div>
        </div>

    <div class="container">
        <div class="profile-section">
            <?php
                    if (!isset($_SESSION['userId'])) {
                        header('Location: /404.php');
                        exit();
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }  ?>
        <?php

 
    $joueur_id= $_SESSION['userId'];

    
    $stmt = $db->prepare("SELECT pseudo, bio, date_heure_inscription FROM utilisateur WHERE id = ?");
    $stmt->execute([$joueur_id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($utilisateur) {
        $pseudo = $utilisateur['pseudo'];
        $bio = $utilisateur['bio'];
        $date_inscription = $utilisateur['date_heure_inscription'];
    

    } else {

        $_SESSION['date'] ="Utilisateur non trouvé.";
        header('Location: ../projet/profil.php');
        exit;
    }
    
    $db = null;
    ?>
   
    <div class="edit-section">
    <div class="player_info">

            <img class="avatar" src="../utils/imageDL.php" alt="Image de profil">
            <h2><?php echo $pseudo?></h2>
            
            <p><?php echo $bio?></p>
            <br>
            <p><?php echo"Date d'inscription : ".  $date_inscription?></p>
            <br>
            <br>
            </div>
            <br>
            <form class="edit-form" action="../utils/imageUpload.php" method="POST" enctype="multipart/form-data">
            <h2>Choisissez une image :</h2> 
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" required>
            <button type="submit" class="submit-btn">Changer de Photo</button>
            </form>
            <br>
            <br> 
            <h2>supprimer son compte :</h2> 
            <p>Pour supprimer votre compte, tapez <p class="span">CONFIRMER.</p></p>
            <br>
            <form class="edit-form" action="../utils/accountDelete.php" method="post">
            <input type="text" class="ntextzone" name="delete" placeholder="CONFIRMER" required>
            <button type="submit" class="submit-btn" >Suppression</button>
            </form>
            
        </div>
        </div>

        <div class="edit-section">
        <?php
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }  
                    if (isset($_SESSION['good'])) {
                        echo "<p style='color:green'>" . $_SESSION['good'] . "</p>";
                        unset($_SESSION['good']);
                    }  ?>
            <h2>Profil :</h2>
            <form class="edit-form" action="../utils/userBioConfirm.php" method="post">
                <input type="text"  class="ntextzone" name="pseudo" placeholder="Pseudonyme" required>
                <input type="text" class="ntextzone" name="bio" placeholder="Bio" required>
                <button type="submit" class="submit-btn">Changer le profil</button>
            </form>
            <h2>Changer d'adresse e-mail :</h2>
            <form class="edit-form" action="../utils/emailUpdateConfirm.php" method="post">
            <input type="email" class="ntextzone" name="old_email" placeholder="Ancienne adresse e-mail" required>
            <input type="email" class="ntextzone" name="new_email" placeholder="Nouvelle adresse e-mail" required>
            <input type="password" class="ntextzone" name="password" placeholder="Mot de passe" required>
                <button type="submit" class="submit-btn">Changer l'email</button>
            </form>

            <h2>Changer de mot de passe :</h2>
            <form class="edit-form" action="../utils/passwordChangeConfirm.php" method="post">

            <input type="password" class="ntextzone" name="old_password" placeholder="Ancien mot de passe" required>
            <input id="password_input" type="password" class="ntextzone" name="motdepasse" placeholder="Nouveau mot de passe" required>
            <input type="password" class="ntextzone" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required>
            <div id="pwd_strength">
                <div id="bar_pwd_base">
                    <div id="bar_pwd_strength"></div>
                </div>
                <p id="text_strength"> </p>
            </div>


                <button type="submit" class="submit-btn">Changer le mot de passe</button>
            </form>

        </div>
        
    </div>


    <?php include __DIR__ . '/partials/footer.php'; ?>


    
    
    <script src="../../assets/script/passwordstrength.js"></script>
</body>

</html>
