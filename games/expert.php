<!DOCTYPE html>
<html lang="fr">

<?php include __DIR__ . '../../utils/common.php';
$theme = no_theme()?>
<link rel="stylesheet" href="<?php echo $theme?>">

<?php $page = 'expert'; include __DIR__ . '/../partials/head.php';?>

<?php include __DIR__ . '../../partials/header.php'; ?>

<?php
                    if (!isset($_SESSION['userId'])) {
                        // Redirection vers la page 404
                        header('Location: /404.php');
                        exit();
                    }else{
                        $id= $_SESSION['userId'];
                        $best_score = best_score($id,3);
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
                        unset($_SESSION['error']);
                    }  ?>

<body class="simp">
    <section class="choix" >
        <form method="POST" action="memory.php" class="menu_theme">
            <select name="css_theme" class="search_theme" >
                <option value = ''>Halloween</option>
                <option value = 'AmongUs'>AmongUs</option>
                <option value = 'Araignee'>Araignee</option>
                <option value = 'Mechant'>Mechant</option>
                <option value = 'Shrek'>Shrek</option>
                <input type="submit" name="submitform" value="valider" class="submitform">
            </select>
        </form>
        <select class="search_difficulties" onchange="location = this.value;">
            <option value="/games/expert.php"> Difficulté expert</option>
            <option value="/games/memory.php">Difficulté facile</option>
            <option value="/games/intermediaire.php">Difficulté intermédiaire</option>
            <option value="/games/impossible.php">Difficulté impossible</option>
        </select>
    </section>


    <section class="Jeux">
        <aside>
            <p class="Score_vie">Vie</p>
            <div class="vie">
                <div class="vieS"></div>
                <div class="vieS"></div>
                <div class="vieS"></div>
            </div>
            <p class="Score_vie">Score</p>
            <p class="points">4</p>
            <p class="Score_vie">Meilleur score</p>
            <p class="points"><?php echo $best_score?></p>
        </aside>
        <article>
            <table class="taille_tableau">
                <tbody>
                    <tr>
                        <td><button class="button52"></button></td>
                        <td><button class="button38"></button></td>
                        <td><button class="button16"></button></td>
                        <td><button class="button38"></button></td>
                        <td><button class="button59"></button></td>
                        <td><button class="button35"></button></td>
                        <td><button class="button34"></button></td>
                        <td><button class="button6"></button></td>
                        <td><button class="button21"></button></td>
                        <td><button class="button70"></button></td>
                        <td><button class="button15"></button></td>
                        <td><button class="button33"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button62"></button></td>
                        <td><button class="button27"></button></td>
                        <td><button class="button64"></button></td>
                        <td><button class="button12"></button></td>
                        <td><button class="button2"></button></td>
                        <td><button class="button12"></button></td>
                        <td><button class="button47"></button></td>
                        <td><button class="button46"></button></td>
                        <td><button class="button9"></button></td>
                        <td><button class="button11"></button></td>
                        <td><button class="button11"></button></td>
                        <td><button class="button41"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button5"></button></td>
                        <td><button class="button60"></button></td>
                        <td><button class="button22"></button></td>
                        <td><button class="button59"></button></td>
                        <td><button class="button31"></button></td>
                        <td><button class="button71"></button></td>
                        <td><button class="button47"></button></td>
                        <td><button class="button6"></button></td>
                        <td><button class="button36"></button></td>
                        <td><button class="button42"></button></td>
                        <td><button class="button61"></button></td>
                        <td><button class="button53"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button27"></button></td>
                        <td><button class="button72"></button></td>
                        <td><button class="button13"></button></td>
                        <td><button class="button63"></button></td>
                        <td><button class="button30"></button></td>
                        <td><button class="button13"></button></td>
                        <td><button class="button7"></button></td>
                        <td><button class="button41"></button></td>
                        <td><button class="button43"></button></td>
                        <td><button class="button15"></button></td>
                        <td><button class="button21"></button></td>
                        <td><button class="button16"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button30"></button></td>
                        <td><button class="button14"></button></td>
                        <td><button class="button25"></button></td>
                        <td><button class="button23"></button></td>
                        <td><button class="button22"></button></td>
                        <td><button class="button29"></button></td>
                        <td><button class="button48"></button></td>
                        <td><button class="button5"></button></td>
                        <td><button class="button66"></button></td>
                        <td><button class="button3"></button></td>
                        <td><button class="button19"></button></td>
                        <td><button class="button3"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button49"></button></td>
                        <td><button class="button28"></button></td>
                        <td><button class="button28"></button></td>
                        <td><button class="button8"></button></td>
                        <td><button class="button39"></button></td>
                        <td><button class="button23"></button></td>
                        <td><button class="button48"></button></td>
                        <td><button class="button55"></button></td>
                        <td><button class="button32"></button></td>
                        <td><button class="button51"></button></td>
                        <td><button class="button32"></button></td>
                        <td><button class="button53"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button70"></button></td>
                        <td><button class="button63"></button></td>
                        <td><button class="button24"></button></td>
                        <td><button class="button44"></button></td>
                        <td><button class="button54"></button></td>
                        <td><button class="button20"></button></td>
                        <td><button class="button57"></button></td>
                        <td><button class="button1"></button></td>
                        <td><button class="button10"></button></td>
                        <td><button class="button56"></button></td>
                        <td><button class="button21"></button></td>
                        <td><button class="button26"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button65"></button></td>
                        <td><button class="button62"></button></td>
                        <td><button class="button29"></button></td>
                        <td><button class="button68"></button></td>
                        <td><button class="button67"></button></td>
                        <td><button class="button2"></button></td>
                        <td><button class="button60"></button></td>
                        <td><button class="button20"></button></td>
                        <td><button class="button42"></button></td>
                        <td><button class="button45"></button></td>
                        <td><button class="button7"></button></td>
                        <td><button class="button37"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button66"></button></td>
                        <td><button class="button56"></button></td>
                        <td><button class="button65"></button></td>
                        <td><button class="button49"></button></td>
                        <td><button class="button34"></button></td>
                        <td><button class="button39"></button></td>
                        <td><button class="button45"></button></td>
                        <td><button class="button26"></button></td>
                        <td><button class="button1"></button></td>
                        <td><button class="button18"></button></td>
                        <td><button class="button25"></button></td>
                        <td><button class="button69"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button61"></button></td>
                        <td><button class="button54"></button></td>
                        <td><button class="button24"></button></td>
                        <td><button class="button50"></button></td>
                        <td><button class="button57"></button></td>
                        <td><button class="button9"></button></td>
                        <td><button class="button72"></button></td>
                        <td><button class="button17"></button></td>
                        <td><button class="button36"></button></td>
                        <td><button class="button19"></button></td>
                        <td><button class="button69"></button></td>
                        <td><button class="button33"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button58"></button></td>
                        <td><button class="button52"></button></td>
                        <td><button class="button4"></button></td>
                        <td><button class="button43"></button></td>
                        <td><button class="button44"></button></td>
                        <td><button class="button46"></button></td>
                        <td><button class="button40"></button></td>
                        <td><button class="button58"></button></td>
                        <td><button class="button18"></button></td>
                        <td><button class="button10"></button></td>
                        <td><button class="button14"></button></td>
                        <td><button class="button68"></button></td>
                    </tr>
                    <tr>
                        <td><button class="button55"></button></td>
                        <td><button class="button67"></button></td>
                        <td><button class="button40"></button></td>
                        <td><button class="button64"></button></td>
                        <td><button class="button4"></button></td>
                        <td><button class="button71"></button></td>
                        <td><button class="button17"></button></td>
                        <td><button class="button31"></button></td>
                        <td><button class="button35"></button></td>
                        <td><button class="button37"></button></td>
                        <td><button class="button8"></button></td>
                        <td><button class="button50"></button></td>
                    </tr>
                </tbody>
            </table>
        </article>
    </section>

    <?php include __DIR__ . '../../partials/footer.php'; ?>

    <input type="checkbox" id="toggleChat">
    <label for="toggleChat" id="openChatbox">Chatbox</label>

    <div class="chatbox">
        <div class="chatbox-header">
            <span>Chat</span>
            <label for="toggleChat" class="close-btn">&times;</label>
        </div>
        <div class="chatbox-body">
            <ul class="chatHistory">
                <li class="message1">25/10 18:48-Inès : Houpi 20 secondes le niveau Shrek expert ! </li>
                <li class="myHistory">25/10 18:48-Matéis : Trop NULLLLL !!!!</li>
                <li class="message2">25/10 18:49-Clément : Inès RATIO !!!</li>
            </ul>
            <textarea id="chatboxEntry" placeholder="Entrez votre message ici..."></textarea>
        </div>
    </div>


</body>





</html>