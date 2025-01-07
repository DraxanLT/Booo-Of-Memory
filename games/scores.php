<!DOCTYPE html>
<html lang="fr">

<?php $page = 'scores'; include __DIR__ . '/../partials/head.php';?>

<body>


    <?php include __DIR__ . '../../partials/header.php';
    
     ?>

<?php if ($pseudo): ?>
                
                <?php $id= $_SESSION['userId'];?>
             
             <?php else: ?>
                 <?php $id= 0;?>
             <?php endif; ?>
 
    <?php
        include __DIR__ . '../../utils/common.php';
        $sql=tableau_score();
        $message_erreur=exist();
    ?>

    <div id="particles-js">



    <div class="center">
        <div class="titlefade">
            <h1 class="bigtitle">ඞ Classement des joueurs ඞ</h1>
        </div>
    </div>


    <div class="center2">
        <div class="titlefade1">

        </div>
        <div class="displayScore">
            <section>
                <div class="textScore">
                    <table class ='table'>
                        <thead>
                        <tr>
                            <th class='table_head'>Thème du jeu</th>
                            <th class='table_head'>Pseudo du joueur</th>
                            <th class='table_head'>Niveau de difficulté</th>
                            <th class='table_head'>Score du joueur (en secondes)</th>
                            <th class='table_head'>Date et heure de la partie</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                                foreach (($sql)as $row) {
                                    if($row["id"]==$id){
                                        echo "<tr><td class='table_name'>" . $row["nom"]. "</p></td>
                                            <td class='table_name'>" . $row["pseudo"]. " </p></td>
                                            <td class='table_name'>" . $row["difficulte"]. " </p></td>
                                            <td class='table_name'>" . $row["score_partie"]. " </p></td>
                                            <td class='table_name'>" . $row["date_heure_partie"]. " </p></td></tr>";
                                    }
                                    else{
                                        echo "<tr><td class='table_score'>" . $row["nom"]. "</td>
                                            <td class='table_score'>" . $row["pseudo"]. " </td>
                                            <td class='table_score'>" . $row["difficulte"]. " </td>
                                            <td class='table_score'>" . $row["score_partie"]. " </td>
                                            <td class='table_score'>" . $row["date_heure_partie"]. " </td></tr>";
                                    }
                                }
                            ?>
                            <form method="POST" action = "scores.php">
                                <div class="searchBar">
                                    <input type="text" name="pseudo" placeholder="PSEUDO......" class="search" >
                                    <input type="submit" name="submitform" value="Rechercher" class="submitform" >
                                    <?php if ($message_erreur=="false"){
                                        echo "<p style='color:red'>"."  Utilisateur introuvable"."</p>";
                                    } ?>
                                </div>
                            </form>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <?php include __DIR__ . '../../partials/footer.php'; ?>

</body>
</html>
