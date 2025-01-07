<!DOCTYPE html>
<html lang="fr">

<?php $page = 'index'; include __DIR__ . '/partials/head.php';?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@700&display=swap" rel="stylesheet">


<body>

<?php include __DIR__ . '/partials/header.php'; ?>

  
<section class="back_top-site">

        <section class="firstsection">



        <?php if ($pseudo): ?>
                <div class="content">BIENVENUE ABOMINABLE <?php echo htmlspecialchars($pseudo) ; ?> !</div>
            <?php else: ?>
                <div class="content">BIENVENUE JEUNE AVENTURIER</div>

            <?php endif; ?>

            
           
            <?php if ($pseudo): ?>
                <div  class="button-play"><a class="playhypertexte"  href="/games/memory.php">JOUER !</a></div>
            <?php else: ?>
                <div  class="button-play-login"><a class="playhypertexte" href="/login.php">Se connecter</a></div>
            <?php endif; ?>
    
        </section>
    
        </section>
    
        <section class="games" >
            <section class="contenu" >
           
                <article class="theme" > 
                    <a href="/games/memory.php">
                <img class="image-theme" src="/assets/memory/Shrek/main.png "alt="theme1" >
                </a>
                <h1 class="title-theme" >Shrek</H1>
    
            </article>
        </div>
    
            <article class="theme"> 
                <a href="/games/memory.php">
                <img class="image-theme" src="/assets/memory/AmongUs/main.png "alt="theme1" >
            </a>
            <h1 class="title-theme">Among Us</h1>
        </article>
        <article class="theme">
            <a href="/games/memory.php">
                <img class="image-theme" src="/assets/memory/Araignee/main.png" alt="theme1">
            </a>
            <h1 class="title-theme">Araignée</h1>
        </article>
        <article class="theme">
            <a href="/games/memory.php">
                <img class="image-theme" src="/assets/memory/Halloween/main.png" alt="theme1">
            </a>
            <h1 class="title-theme">Halloween</h1>
        </article>
        <article class="theme">
            <a href="/games/memory.php">
                <img class="image-theme" src="/assets/memory/Mechant/main.png" alt="theme1">
            </a>
            <h1 class="title-theme">Méchant</h1>
        </article>
    </section>
</section>

<div class="wrapper">
    <div class="image-container">
        <div class="stats_image"></div>
    </div>

    <?php
    $sql_count = $db->prepare("SELECT COUNT(id) AS number_games FROM score");
    $sql_count->execute();
    $data = $sql_count->fetch(PDO::FETCH_ASSOC);
    $numbergames = htmlspecialchars($data['number_games']);
    ?>

    <?php
    $sql_count = $db->prepare("SELECT COUNT(id) AS number_players FROM utilisateur");
    $sql_count->execute();
    $data = $sql_count->fetch(PDO::FETCH_ASSOC);
    $numberplayers = htmlspecialchars($data['number_players']);
    ?>

    <?php
    $sql_count = $db->prepare("SELECT MIN(score_partie) AS time_record FROM score;");
    $sql_count->execute();
    $data = $sql_count->fetch(PDO::FETCH_ASSOC);
    $timerecord = htmlspecialchars($data['time_record']);
    ?>

    <?php
    $sql_count = $db->prepare("SELECT COUNT(id) AS connected_players FROM utilisateur WHERE date_heure_d_connexion >= NOW() - INTERVAL 10 MINUTE");
    $sql_count->execute();
    $data = $sql_count->fetch(PDO::FETCH_ASSOC);
    $connectedPlayers = htmlspecialchars($data['connected_players']);
    ?>

    <section class="stats">
        <div class="container">
            <div class="item-stats">
                <h2><?php echo $numbergames ?></h2>
                <p>Parties Jouées</p>
            </div>
            <div class="item-stats">
                <h2><?php echo $connectedPlayers ?></h2>
                <p>Joueurs Connectés</p>
            </div>
            <div class="item-stats">
                <h2><?php echo $timerecord . " MIN" ?></h2>
                <p>Temps Record</p>
            </div>
            <div class="item-stats">
                <h2><?php echo $numberplayers ?></h2>
                <p>Joueurs Inscrits</p>
            </div>
        </div>
    </section>
</div>

<H2 class="title-team">NOTRE EQUIPE</H2>
<section class="team-affichage">
    <section class="team-taille">
        <section class="team">
            <div class="members-team">
                <img class="members-image" src="/assets/main/team/13th.png">
                <p class="team-name">Matéis</p>
                <p class="team-post">Scrum Master</p>
            </div>
            <div class="members-team">
                <img class="members-image" src="/assets/main/team/Annabelle.png">
                <p class="team-name">Estelle</p>
                <p class="team-post">Game Developer</p>
            </div>
            <div class="members-team">
                <img class="members-image" src="/assets/main/team/Citrouille.png">
                <p class="team-name">Draxan</p>
                <p class="team-post">Développeur web</p>
            </div>
            <div class="members-team">
                <img class="members-image" src="/assets/main/team/Clown.png">
                <p class="team-name">Saif</p>
                <p class="team-post">Développeur web</p>
            </div>
        </section>
    </section>
</section>
<?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>