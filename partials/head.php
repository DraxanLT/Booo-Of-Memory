<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Booo of Memory est un side d'entraînement de votre mémoire. Retournez une carte et trouvez son semblable jusqu'à avoir toutes les cartes révélées à vous !"/>
    <meta name="keywords" content="jeu, memory, mémoire, entraînement de mémoire, alzheimer, cerveau, cerveau musclé, connaissance, jeu mental, carte"/>
    <meta name="author" content="Matéis, Estelle, Draxan, Saïf"/>
    <link rel="shortcut icon" href="/assets/main/logo_bom.png" />
    <?php if ($page === 'index'): ?>
        <link href="/assets/accueil.css" rel="stylesheet">
        <link href="/assets/contact.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <link href="/assets/header.css" rel="stylesheet">

        <title>Booo Of Memory</title>
    <?php endif; ?>
    <?php if ($page === 'login' || $page === 'register' || $page === 'contact'): ?>
        <link href="/assets/main.css" rel="stylesheet">
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/dstyles.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <link href="/assets/contact.css" rel="stylesheet">
        <?php if ($page === 'login'): ?>
            <title>BOM - Connexion</title>
        <?php endif; ?>
        <?php if ($page === 'register'): ?>
            <title>BOM - Inscription</title>
        <?php endif; ?>
        <?php if ($page === 'contact'): ?>
            <title>BOM - Contact</title>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($page === 'profile'): ?>
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/profil.css" rel="stylesheet">
        <link href="/assets/myaccount.css" rel="stylesheet">
        <title>BOM - Profil</title>
    <?php endif; ?>
    <?php if ($page === 'scores'):?>
        <script src="/assets/script/particles.js"></script>
        <script src="/assets/script/app.js"></script>
        <link href="/assets/score.css" rel="stylesheet">
        <link href="/assets/main.css" rel="stylesheet">
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <title>BOM - Scores</title>
    <?php endif; ?>
    <?php if ($page === 'memory' || $page === 'intermediate' || $page === 'expert' || $page === 'impossible'):?>
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <link href="/assets/contact.css" rel="stylesheet">
        <title>BOM - Jeu</title>
    <?php endif; ?>
    <?php if ($page === 'intermediate' || $page === 'expert' || $page === 'impossible'):?>
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <link href="/assets/contact.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Princess+Sofia&display=swap" rel="stylesheet">
        <title>BOM - Jeu</title>
    <?php endif; ?>
    <?php if ($page === '404'):?>
        <link href="/assets/main.css" rel="stylesheet">
        <link href="/assets/accueil.css" rel="stylesheet">
        <link href="/assets/header.css" rel="stylesheet">
        <link href="/assets/404.css" rel="stylesheet">
        <link href="/assets/footer.css" rel="stylesheet">
        <title>BOM - 404</title>
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=New+Rocker&display=swap" rel="stylesheet">
</head>