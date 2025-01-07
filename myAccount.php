

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Booo of Memory est un side d'entraînement de votre mémoire. Retournez une carte et trouvez son semblable jusqu'à avoir toutes les cartes révélées à vous !"/>
    <meta name="keywords" content="jeu, memory, mémoire, entraînement de mémoire, alzheimer, cerveau, cerveau musclé, connaissance, jeu mental, carte"/>
    <meta name="author" content="Matéis, Estelle, Draxan, Saïf"/>
    <title>TPOM - Mon Compte</title>
    <link href="../assets/main.css" rel="stylesheet">
    <link href="../assets/header.css" rel="stylesheet">
    <link href="../assets/dstyles.css" rel="stylesheet">
    <link href="../assets/footer.css" rel="stylesheet">
    <link href="../assets/contact.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/myaccount.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
</head>

<body>
    
<?php include __DIR__ . '/partials/header.php'; ?>
    


    <div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">Compte</h1>
        </div>
        <div class="cbox">
            <div class="mbox">
            <?php
                    session_start();
                    if (!isset($_SESSION['userId'])) {
                        header('Location: /404.php');
                        exit();
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }  ?>
   
               
                <form class="trdbox" action="../utils/userBioConfirm.php" method="post">
                    
                <h2 class="left">Profil</h2>
                    <p class="smallgap"></p>

                <input type="text" class="ntextzone" name="pseudo" placeholder="Pseudonyme" required>
                    <p class="smallgap"></p> 
                    <input type="text" class="biglongtextzone" name="bio" placeholder="Bio" required>
                    <p class="smallgap"></p>
              
                 <p class="smallgap"></p>
                    <button type="submit" id="confirm">Confirmer les modifications</button>
                
                </form>


                <form class="trdbox" action="../utils/emailUpdateConfirm.php" method="post">
                <h2 class="left">Changer d'adresse e-mail</h2>
                <p class="smallgap"></p>

                <input type="email" class="ntextzone" name="old_email" placeholder="Ancienne adresse e-mail" required>
                <p class="smallgap"></p>
                
                <input type="email" class="ntextzone" name="new_email" placeholder="Nouvelle adresse e-mail" required>
                <p class="smallgap"></p>
                
                <input type="password" class="ntextzone" name="password" placeholder="Mot de passe" required>
                <p class="smallgap"></p>

    
                <button type="submit" id="confirm">Confirmer les modifications</button>
                </form>


                <form class="trdbox" action="../utils/passwordChangeConfirm.php" method="post">
                <h2 class="left">Changer de mot de passe</h2>
                <p class="smallgap"></p>

                <input type="password" class="ntextzone" name="old_password" placeholder="Ancien mot de passe" required>
                <p class="smallgap"></p>

                <input type="password" class="ntextzone" name="new_password" placeholder="Nouveau mot de passe" required>
                <p class="smallgap"></p>

                <input type="password" class="ntextzone" name="confirm_password" placeholder="Confirmer le nouveau mot de passe" required>
                <button type="submit" id="confirm">Confirmer les modifications</button>
                </form>

            </div>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    </body>
</html>