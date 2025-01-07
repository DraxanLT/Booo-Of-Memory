<!DOCTYPE html>
<html lang="fr">

<?php $page = 'contact'; include __DIR__ . '/partials/head.php';?>

<body>
    
    <?php include __DIR__ . '/partials/header.php'; ?>
    
    <div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">Contact</h1>
        </div>
        <div class="cbox">
            <div class="cinfos">
                <div class="clogobox">
                    <div class="clogophone"></div>
                    <p class="smallgap"></p>
                    <div>
                        <div class="ctext">06.05.04.03.02</div>
                        <div class="ctextsmall">Téléphone : 06.05.04.03.02</div>
                        <p class="smallgap"></p>
                    </div>
                </div>
                <div class="clogobox">
                    <div class="clogomail"></div>
                    <p class="smallgap"></p>
                    <div>
                        <div class="ctext">support@powerofmemory.com</div>
                        <div class="ctextsmall">Adresse email : support@powerofmemory.com</div>
                        <p class="smallgap"></p>
                    </div>
                </div>
                <div class="clogobox">
                    <div class="clogoloca"></div>
                    <p class="smallgap"></p>
                    <div>
                        <div class="ctext">Paris</div>
                        <div class="ctextsmall">Localisation : Paris</div>
                        <p class="smallgap"></p>
                    </div>
                </div>
                <p class="smallgap"></p>
            </div>
            <p></p>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            ?>
            <form class="mbox" action="utils/contactProcess.php" method="post">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }  
                if (isset($_SESSION['good'])) {
                    echo "<p style='color:green'>" . $_SESSION['good'] . "</p>";
                    unset($_SESSION['good']);
                }  
                ?>
                <div class="trdbox">
                    <div class="frtbox">
                        <input type="text" class="ntextzone" name="name" placeholder="Votre nom" required>
                        <p class="smallgap"></p>
                        <input type="email" class="ntextzone" name="email" placeholder="Votre adresse email" required>
                    </div>
                </div>
                <div class="trdbox">
                    <input type="text" class="longtextzone" name="subject" placeholder="Sujet" required>
                    <p class="smallgap"></p>
                    <textarea type="text" class="biglongtextzone" name="message" placeholder="Message" required></textarea>
                    <p class="smallgap"></p>
                </div>
                <button type="submit" id="confirm">Envoyer</button>
            </form>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
