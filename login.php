<!DOCTYPE html>
<html lang="fr">

<?php $page = 'login'; include __DIR__ . '/partials/head.php';?>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

    <div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">Connexion</h1>
        </div>
        <?php

            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
        ?>
        <div class="cbox">
            <form class="mbox" action="/utils/userConnexion.php" method="post">
                <input type="text" class="ntextzone" name="email" placeholder="Email" required>
                <p class="smallgap"></p> 
                <input type="password" class="ntextzone" name="password" placeholder="Mot de passe" required>
                <p class="smallgap"></p>
                <div class="left">Mot de passe oublié ?</div>
                <p class="smallgap"></p>
                <button type="submit" id="confirm">Se connecter</button>
                <p class="smallgap"></p>
            </form>
        </div>
    </div>



</body>



<?php include __DIR__ . '/partials/footer.php'; ?>

</html>