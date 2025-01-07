<?php
header('Content-Type: application/json');
$response = [];

try {
    include __DIR__ . '/../utils/database.php';
    $db = connectToDbAndGetPdo();
    session_start();
    date_default_timezone_set('Europe/Paris'); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $message = trim($data['message']);
        $userId = $_SESSION['userId'];
        $pseudo = $_SESSION['pseudo'];
        $jeuId = 1; // a modif apres quand j'aurais la version d'estelle
        $isSender = 1; 

        error_log('Message: ' . $message);
        error_log('User ID: ' . $userId);

        if (!empty($message) && isset($userId)) {
            $stmt = $db->prepare("INSERT INTO chat (jeu_id, joueur_id, isSender, message, date_heure_message) VALUES (:jeu_id, :joueur_id, :isSender, :message, NOW())");
            $stmt->bindParam(':jeu_id', $jeuId);
            $stmt->bindParam(':joueur_id', $userId);
            $stmt->bindParam(':isSender', $isSender);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            $response['status'] = 'success';
            $response['message'] = 'Message envoyé avec succès';
            $response['data'] = [
                'message' => $message,
                'date' => date('d/m H:i'), 
                'pseudo' => $pseudo 
            ];
        } else {
            throw new Exception('Message vide ou utilisateur non connecté');
        }
    } else {
        throw new Exception('Méthode de requête non valide');
    }
} catch (Exception $e) {
    error_log('Erreur: ' . $e->getMessage());
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>