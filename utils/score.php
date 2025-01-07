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
        $userId = $_SESSION['userId']; 
        $date=date('Y-m-d H:i:s');
        $theme =   $data['theme'];
        $difficulte= $data['difficulte'];
        $score=$data['time'];
        if (isset($userId)) {
            $stmt = $db->prepare("INSERT INTO score (joueur_id, score_partie, jeu_id,date_heure_partie,difficulte) 
            VALUES (:joueur_id,:score_game,:jeu_id,:date,:difficulte)");
            $stmt->bindParam(':jeu_id', $theme);
            $stmt->bindParam(':difficulte', $difficulte);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':joueur_id', $userId);
            $stmt->bindParam(':score_game', $score);

            $stmt->execute();

        } else {
            throw new Exception('Utilisateur non connecté');
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