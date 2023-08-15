<?php
session_start();
/* //si la session n'est pas active on redirige vers 
// index pour éviter que des user
malveillant tente d'y accéder directement par l'url*/
if(!$_SESSION['mdp']){
    header('Location: index.php');
}
$pseudo = $_SESSION['pseudo'];

$admin = "root";
$pass = "root";

//connexion à la dataBase
$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=UTF8', $admin, $pass);
//je vérifie que la variable existe
if(isset($_POST['upload'])){
//je vérifie que les champs ne soient pas vide 
    if(!empty($_POST['title']) AND !empty($_POST['content'])){
        // on utilise htmlspecialchars pour encoder l'entrée
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        //je declare ma variable pour enregistrer l'article en database
        $insertArticle = $bdd->prepare('INSERT INTO articles(title,content )VALUES(?, ?)');   
        // on demande à php de nous renvoyer un tableau
        $insertArticle-> execute(array($title, $content));
     
    } else {
        echo "Veuillez compléter tous les champs";
    }

}
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Home</title>
    <link rel="stylesheet" href="homeStyle.css" />
</head>
<body class='container-home'>

    <!-- home-header -->
    <div class='head-home'>
        <a href="deconnexion.php">
            <button>Se déconnecter</button>
        </a>
        <h2>Bienvenue <span><?php echo ($pseudo) ?></span> enjoy!</h2>  
    </div>

    <!-- home-container -->
    <div class='home-body'>
        <!-- home-left -->
        <div class='home-left'>
            <form action="" method="POST">
                <input type="text" name='title' placeholder="Titre de l'article">
                <br>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Racontez-nous..."></textarea>
                <br> <br>
                <input type="submit" name='upload'>
            </form>
        </div>
        <div class="line"></div>
        <!-- home-right -->
        <div class='home-right'>
            <h2>Ici il y aura les articles</h2>
        </div>
    </div>

        <!-- home-right -->


   
    
   <!-- footer -->
   <?php include_once('footer.php'); ?>
</body>
</html>