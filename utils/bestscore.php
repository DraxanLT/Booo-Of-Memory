<?php

try {
    include __DIR__ . '/../utils/database.php';
    $db = connectToDbAndGetPdo();
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);


        $userId = $_SESSION['userId'];


        $theme = $data['theme'];
        $difficulte = $data['difficulte'];


        if (isset($userId)) {
            $sql_best_score = 'SELECT score.score_partie
                       FROM score
                       JOIN jeu ON score.jeu_id = jeu.id 
                       JOIN utilisateur ON score.joueur_id = utilisateur.id 
                       JOIN difficulte ON score.difficulte = difficulte.id
                       WHERE utilisateur.id = :id AND difficulte.id = :difficulte AND jeu.id = :jeu;
                       ORDER BY score.score_partie ASC
                       LIMIT 1';
            $searching = $db->prepare($sql_best_score);
            $searching->execute(array('id' => $userId, 'difficulte' => $difficulte, 'jeu' => $theme));
            if ($searching->rowCount() <= 0) {
                echo json_encode(["bestscore"=>"aucun score"]);
            } else {
                $data = $searching->fetch();
                echo json_encode(["bestscore"=>$data["score_partie"]]);
                }
            }
        } else {
            echo json_encode(["bestscore"=>"Erreur aucune session"]);
        }
} catch (Exception $e) {
    error_log('Erreur: ' . $e->getMessage());
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}




?>