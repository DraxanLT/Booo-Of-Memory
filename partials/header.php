<?php

include __DIR__ . '/../utils/database.php';

$db = connectToDbAndGetPdo();

session_start();

$pseudo = isset($_SESSION['userId']) ? getPseudoFromSession($_SESSION['userId'], $db) : null;
$_SESSION['pseudo'] = $pseudo; // pour le chat
function getPseudoFromSession($userId, $db) {
    $request = $db->prepare("SELECT pseudo FROM utilisateur WHERE id = :id");
    $request->bindParam(':id', $userId);
    $request->execute();
    $user = $request->fetch(PDO::FETCH_ASSOC);
    return isset($user['pseudo']) ? $user['pseudo'] : null;
}
?>

<link rel="stylesheet" href="/assets/header.css">
<link rel="stylesheet" href="/assets/config.css">


<?php
$current_page = basename($_SERVER['SCRIPT_NAME']);
echo "<!-- Current page: $current_page -->";
?>

<header class="header">
    <nav>
        <div class="logo">
            <a href="/index.php">BOOO OF <span>MEMORY</span></a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-icon">&#9776;</label>
        <ul class="menu">
            <li><a href="/index.php" class="<?php echo $current_page === 'index.php' ? 'active' : ''; ?>">Accueil</a></li>
            <?php if ($pseudo): ?>
                <li><a href="/games/memory.php" class="<?php echo $current_page === 'memory.php' ? 'active' : ''; ?>">JEU</a></li>
            <?php endif; ?>
            <li><a href="/games/scores.php" class="<?php echo $current_page === 'scores.php' ? 'active' : ''; ?>">Score</a></li>
            <li><a href="/contact.php" class="<?php echo $current_page === 'contact.php' ? 'active' : ''; ?>">NOUS CONTACTER</a></li>
            <?php if ($pseudo): ?>
                <li><a href="/profil.php" class="<?php echo $current_page === 'profil.php' ? 'active' : ''; ?>"><?php echo htmlspecialchars($pseudo); ?></a></li>
                <li><a href="/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/login.php" class="<?php echo $current_page === 'login.php' ? 'active' : ''; ?>">Connexion</a></li>
                <li><a href="/register.php" class="<?php echo $current_page === 'register.php' ? 'active' : ''; ?>">Inscription</a></li>
            <?php endif; ?>



        </ul>
        <label>
        <input type="checkbox" id="mode" />
            <div class="toggle-switch"></div>
            </label>
    </nav>
    
    <script src="/assets/script/switchmode.js"></script>
</header>