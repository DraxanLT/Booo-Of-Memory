<!DOCTYPE html>
<html lang="fr">

<?php $page = '404'; include __DIR__ . '/partials/head.php';?>

<body>
    <?php include __DIR__ . '/partials/header.php'; ?>
    
    <div class="error-container">
        <h1>Erreur 404</h1>
        <p>Vous devez être connecté pour accéder à cette page.</p>
        <a href="/login.php">Se connecter</a>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
