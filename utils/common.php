<?php
function exist() {
    $db = connectToDbAndGetPdo();
    if (isset($_POST['submitform'])) {
        $sql_searching_name = 'SELECT pseudo 
                               FROM utilisateur 
                               WHERE pseudo = :pseudo';

        $searching = $db->prepare($sql_searching_name);
        $searching->execute(array('pseudo' => $_POST["pseudo"]));
        if ($searching->rowCount() > 0) {
            return "true";
        } elseif ($_POST["pseudo"] == "") {
            return "true";
        } else {
            return "false";
        }
    }
    $db = null;
}

function tableau_score_joueur() {
    $db = connectToDbAndGetPdo();
    if (isset($_POST['submitform'])) {
        if ($_POST["pseudo"] == "") {
            return null;
        } else {
            $exist = exist();
            if ($exist == true) {
                $sql_player = 'SELECT jeu.nom,
                                      utilisateur.id,
                                      utilisateur.pseudo,
                                      difficulte.nom as "difficulte",
                                      score.score_partie,
                                      score.date_heure_partie
                               FROM score
                               JOIN jeu ON score.jeu_id = jeu.id
                               JOIN utilisateur ON score.joueur_id = utilisateur.id
                               JOIN difficulte ON score.difficulte = difficulte.id
                               WHERE utilisateur.pseudo = :pseudo
                               ORDER BY score.score_partie ASC
                               LIMIT 10';
                $request = $db->prepare($sql_player);
                $request->execute(array('pseudo' => $_POST["pseudo"]));
                $database_array = $request->fetchAll();
                return $database_array;
            } else {
                return null;
            }
        }
    }
    $db = null;
}

function tableau_score() {
    $db = connectToDbAndGetPdo();
    $database_array = tableau_score_joueur();
    if ($database_array == null) {
        $sql_score = 'SELECT jeu.nom,
                             utilisateur.id, 
                             utilisateur.pseudo, 
                             difficulte.nom as "difficulte", 
                             score.score_partie, 
                             score.date_heure_partie
                      FROM score
                      JOIN jeu ON score.jeu_id = jeu.id 
                      JOIN utilisateur ON score.joueur_id = utilisateur.id 
                      JOIN difficulte ON score.difficulte = difficulte.id
                      ORDER BY score.score_partie ASC
                      LIMIT 10';
        $requete = $db->query($sql_score);
        $database_score = $requete->fetchAll();
        $database_array = $database_score;
        return $database_array;
    } else {
        return $database_array;
    }
    $db = null;
}

function theme_switcher() {
    if (isset($_POST['submitform'])) {
        if ($_POST['css_theme'] == "AmongUs") {
            $url = '../../assets/memory/AmongUs/theme.css';
            return $url;
        } else if ($_POST['css_theme'] == 'Araignee') {
            $url = '../../assets/memory/Araignee/theme.css';
            return $url;
        } else if ($_POST['css_theme'] == 'Mechant') {
            $url = '/assets/memory/Mechant/theme.css';
            return $url;
        } else if ($_POST['css_theme'] == 'Shrek') {
            $url = '/assets/memory/Shrek/theme.css';
            return $url;
        } else {
            $url = '/assets/memory/Halloween/theme.css';
            return $url;
        }
    }
}

function no_theme() {
    $url = theme_switcher();
    if ($url == null) {
        return '/assets/memory/Halloween/theme.css';
    } else {
        return $url;
    }
}

function best_score($id, $difficulte) {
    $db = connectToDbAndGetPdo();
    $sql_best_score = 'SELECT score.score_partie
                       FROM score
                       JOIN jeu ON score.jeu_id = jeu.id 
                       JOIN utilisateur ON score.joueur_id = utilisateur.id 
                       JOIN difficulte ON score.difficulte = difficulte.id
                       WHERE utilisateur.id = :id AND difficulte.id = :difficulte
                       ORDER BY score.score_partie ASC
                       LIMIT 1';
    $searching = $db->prepare($sql_best_score);
    $searching->execute(array('id' => $id, 'difficulte' => $difficulte));
    if ($searching->rowCount() <= 0) {
        return "aucun score";
    } else {
        $data = $searching->fetchAll();
        foreach ($data as $row) {
            return htmlspecialchars($row['score_partie']);
        }
    }
}
?>
