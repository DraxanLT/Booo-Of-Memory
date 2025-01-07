<!DOCTYPE html>
<html lang="fr">

<?php $page = 'register'; include __DIR__ . '/partials/head.php';?>

<body>
    
<?php include __DIR__ . '/partials/header.php'; ?>
    

<div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">Inscription</h1>
        </div>
        <div class="cbox">
            <div class="mbox">
        <form action="/utils/submit.php" method="post">
                <input type="email" class="ntextzone" name="email" placeholder="Email" required>
                <p class="smallgap"></p>
                <input type="text" class="ntextzone" name="pseudonyme" placeholder="Pseudonyme" required>
                
                <p class="smallgap"></p>
                <div class="left">Voir la règlementation sur les pseudonymes</div>
                <p class="smallgap"></p>
                <input id="password_input" type="password" class="ntextzone" name="motdepasse" placeholder="Mot de passe" required>
                <p class="smallgap"></p>
        
                <input type="password" class="ntextzone" name="confirmmotdepasse" placeholder="Confirmer le mot de passe" required>
                <p class="smallgap"></p>
                <div id="pwd_strength">
                    <div id="bar_pwd_base">
                        <div id="bar_pwd_strength"></div>
                    </div>
                    <p id="text_strength"> </p>
                </div>
                <?php
                if (isset($_SESSION['erreur'])) {
                    echo "<p style='color:red'>" . $_SESSION['erreur'] . "</p>";
                    unset($_SESSION['erreur']);
                }
                ?>
        <p class="smallgap"></p>
                <input type="submit" id="confirm" value="Envoyer">
                
                </form>
            </div>
        </div>
    </div>



    
    <?php include __DIR__ . '/partials/footer.php'; ?>
    <script src="../../assets/script/passwordstrength.js"></script>
</body>





</html>