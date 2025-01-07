<?php include __DIR__ . '../../partials/header.php'; ?>
<?php
// PARTIE CHAT
$query = "SELECT 
    c.id_chat,
    c.message,
    c.date_heure_message,
    c.joueur_id,
    u.id AS joueur_id,
    u.pseudo
FROM chat AS c
JOIN utilisateur AS u ON c.joueur_id = u.id
WHERE c.date_heure_message >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
ORDER BY c.date_heure_message ASC"; 

$result = $db->prepare($query);
$result->execute();
$messages = $result->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message']) && isset($_SESSION['userId'])) {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        $stmt = $db->prepare("
            INSERT INTO chat (jeu_id, joueur_id, isSender, message, date_heure_message)
            VALUES (:jeu_id, :joueur_id, :isSender, :message, NOW())
        ");
        
        $stmt->execute([
            'jeu_id' => 1,
            'joueur_id' => $_SESSION['userId'],
            'isSender' => 1,
            'message' => $message
        ]);
    }
}
?>

<?php
// Partie API CAT
$catApiUrl = "https://api.thecatapi.com/v1/images/search?mime_types=gif";
$catGif = "";

try {
    $response = file_get_contents($catApiUrl);
    if ($response !== false) {
        $data = json_decode($response, true);
        if (isset($data[0]['url'])) {
            $catGif = $data[0]['url'];
        }
    }
} catch (Exception $e) {
    // on retourne rien (au cas ou l'api est down au moins ça ne bloque rien)
}

include __DIR__ . '../../utils/common.php';

?>
<?php
                    if (!isset($_SESSION['userId'])) {
                        // Redirection vers la page 404
                        header('Location: /404.php');
                        exit();
                    }else{
                        $id= $_SESSION['userId'];
                        $best_score = best_score($id,1);
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }  ?>


<!DOCTYPE html>
<html lang="fr">


<?php $page = 'memory'; include __DIR__ . '/../partials/head.php';?>
<body>
    <section class="choix" >
        <select id="theme" name="css_theme" class="search_difficulties" >
            <option value = '1'>Halloween</option>
            <option value = '2'>AmongUs</option>
            <option value = '3'>Araignee</option>
            <option value = '4'>Mechant</option>
            <option value = '5'>Shrek</option>
        </select>
        <select id="difficulte" class="search_difficulties">
            <option value="1">Difficulté facile</option>
            <option value="2"> Difficulté expert</option>
            <option value="3">Difficulté intermédiaire</option>
            <option value="4">Difficulté impossible</option>
        </select>
        <button name="submitform" class="playnow">JOUE</button>
    </section>

    <section class="Jeux">
        <aside>
            <p class="Score_vie">Vie</p>
            <div class="vie">
                <div class="coeurcomplet" id="3"></div>
                <div class="coeurcomplet" id="2"></div>
                <div class="coeurcomplet" id="1"></div>
            </div>

            <p class="Score_vie">Score</p>
            <p id="chronotime" class="points">00:00</p>
            <p class="Score_vie">Meilleur score</p>
            <p class="bestscore" ></p>
        </aside>
        <article>
            <div class="rien" id="fin"></div>
            <table class="taille_tableau">
                <tbody class="grille">
                </tbody>
            </table>
        </article

        </section>


       
    <input type="checkbox" id="toggleChat">
    <label for="toggleChat" id="openChatbox">Chat</label>
    
    <div class="chatbox">
        <div class="chatbox-header">
            <span>Chat</span>
            <label for="toggleChat" class="close-btn">&times;</label>
        </div>

        <?php if (!empty($catGif)): ?>
        <div class="cat-gif-container">
            <img src="<?php echo htmlspecialchars($catGif); ?>" alt="Cat GIF" class="cat-gif">
        </div>
        <?php endif; ?>
        <div class="chatbox-body">
            <ul class="chatHistory" id="chatHistory">
                <?php foreach($messages as $message): ?>
                    <li class="<?php echo ($message['joueur_id'] == $_SESSION['userId']) ? 'myHistory' : 'message1' ?>">
                        <?php 
                        echo date('d/m H:i', strtotime($message['date_heure_message'])) . 
                             '-' . htmlspecialchars($message['pseudo']) . ' : ' . 
                             htmlspecialchars($message['message']);
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if(isset($_SESSION['userId'])): ?>
            <div class="chat-form">
                <textarea id="chatboxEntry"  class="chatboxEntry" placeholder="Entrez votre message ici..." required></textarea>
                <button id="sendMessage" class="send-button">Envoyer</button>
            </div>
            <?php endif; ?>
        </div>
    </div>

<script>
document.querySelector('#chatboxEntry').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
    }
});

document.querySelector('#sendMessage').addEventListener('click', function () {
    sendMessage();
});
function scrollToBottom() {
    const chatHistory = document.querySelector('#chatHistory');
    chatHistory.scrollTop = chatHistory.scrollHeight;
}
function sendMessage() {
    const messageInput = document.querySelector('#chatboxEntry');
    const message = messageInput.value.trim(); 
    const userId = <?php echo json_encode($_SESSION['userId']); ?>;
    const pseudo = <?php echo json_encode($_SESSION['pseudo']); ?>;
    const jeuId = 1;
    const isSender = 1;
    if (message.length >= 3 && userId) {
        fetch('/utils/chatHandler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: message, jeu_id: jeuId, isSender: isSender })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                messageInput.value = '';
                const chatHistory = document.querySelector('#chatHistory');
                const newMessage = document.createElement('li');
                newMessage.classList.add('myHistory');
                newMessage.textContent = `${data.data.date} - ${data.data.pseudo} : ${data.data.message}`;
                chatHistory.appendChild(newMessage);
                scrollToBottom()
            } else {
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        console.error('Message must be at least 3 characters long.');
    }
}
document.querySelector('#toggleChat').addEventListener('change', function () {
    if (this.checked) {
        scrollToBottom();
    }
});
</script>
<script src="/assets/script/chrono.js"></script>
<script src="../../assets/script/memory.js"></script>


</body>
<?php include __DIR__ . '../../partials/footer.php'; ?>
</html>
