<?php
session_start();
// include "./config/verif_superglobal.php";
require_once "./config/connexion.php";

$prepareCover = $connexion->prepare("SELECT * FROM songs ORDER BY RAND() LIMIT 6");
$prepareCover->execute();
$coverlist = $prepareCover->fetchAll(PDO::FETCH_ASSOC);


// lecture de sons en-bas 
$prepareSQL1 = $connexion->prepare("SELECT * FROM songs ORDER BY RAND() LIMIT 1");
$prepareSQL1->execute();
$songlistrand = $prepareSQL1->fetch(PDO::FETCH_ASSOC);

$prepareSQL2 = $connexion->prepare("SELECT * FROM songs ORDER BY id ASC LIMIT 1");
$prepareSQL2->execute();
$songlist = $prepareSQL2->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spotify</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="./style/style.css">
</head>
<header>
  <nav class="navbar  nav">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" alt="menu">
        <img class="logo" src="./images/spotify.png">
      </a>



      <?php if (!empty($_SESSION["pseudo"])){

      }else{
      echo'<a href="./register.php">
        <!-- inscription  -->
        <button class="btn btn-outline fs-5 subscribe " type="submit">S\'inscrire</button>
      </a>';  }; ?>


  <!-- le bouton est a mettre dans une condition if  -->
  <?php if (!empty($_SESSION["pseudo"])){
  echo '<form action="./process/logout.php" method="post">
          <button type="submit"  class="btn btn-outline fs-5 subscribe ">Déconnexion</button>
  </form>';
  }?>
  

<!-- condition if pour la connexion également  -->
  <?php
if (!empty($_SESSION["pseudo"])) {

} else {
    echo '<a href="./pagelogin.php">
            <!-- connexion session  -->
            <button type="submit" class="btn btn-light fs-5 login">Connexion</button>
          </a>';
}
?>




    </div>
  </nav>
</header>

<body>
  <!-- boutons de droite  -->
  <div class="row g-0 text-center">

    <div class="col-2 col-md-2">
      <div class="d-grid col-6 ">
        <button class="btn btn-flex mt-3 text-start" type="button"><a href="./index.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i> Accueil</a></button>
        <button class="btn btn-flex text-start" type="button"><a href=""><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i> Rechercher</a></button>
        <button class="btn btn-flex mt-1 text-start" type="button"><a href=""><i class="fa-solid fa-book-open" style="color: #ffffff;"></i> Bibiliothèque</a></button>
        <div class="test">
          <div class="inside ">
            <button class="btn btn-flex mt-5 btninside" type="button"><a href="">Créer une playlist</a></button>

            <p class="text-white fs-5 mt-1">C'est simple nous allons vous aider</p>
          </div>
        </div>
      </div>


    </div>





    <!-- grosse partie droite  Le code doit se passer ici !! -->
    <div class="col-sm-10 col-md-10">
      <div class="secteur"> 
        <br>
        
        <br>
        <?php if (!empty($_SESSION["pseudo"])) {
            echo '<p class="text-white fs-3">' . "Bienvenue " .  $_SESSION["pseudo"] . " dans votre univers musical " .
               '</p>';
           } else {
           // Afficher autre chose ou ne rien afficher si la session n'est pas ouverte
         echo '<p class="text-white fs-3">Connectez-vous pour accéder à vos Playlists</p>';
         }; ?>
         </p>
         <br>
        <!-- flex box à l'interieur de la section  -->
        
        <div class="">
        <div id="message" class="text-white fs-2"><i class="fa-solid fa-spinner fa-spin-pulse fa-2xl" style="color: #ffffff;"></i></div>
        </div>
        <br>
        

        <!-- test pour les flex box musicales  -->
        <div class="d-flex justify-content-center">

                  <?php foreach ($coverlist as $key ) { ?>
                    
                  
                  <div class="p-2 flexa ms-4">
                    <!-- div a l'intérieur  -->
                    <div class="flexy">
                      <div class="teste"  style="background-image: url('../images/<?=$key["cover"]?>')"></div>
                    </div>
                    <p class="text-white fs-5"><?php echo $key["artiste"] ?></p>
                    <p class="text-secondary fs-6"><?php echo $key["name"] ?> </p>
                      
                  </div>
                <?php } ?>




                  <!-- <div class="p-2 flexa">Flex item 2</div>
                  <div class="p-2 flexa">Flex item 3</div>
                  <div class="p-2 flexa">Flex item 4</div>
                  <div class="p-2 flexa">Flex item 5</div>
                  <div class="p-2 flexa me-4">Flex item 6</div> -->
  
                </div>
              </div>

              
              
              <!-- lecteur footer -->
            <section class="lecteur d-flex justify-content-around">
              <!-- /* pochette et titre dans le lecteur a gauche  */ -->







      <!-- CODE BOUTON AFFICHER COVER NOM ARTISTE ET PLAY MUSIQUE -->
  

              <div>
                  <div class="mt-5 content teste"  style="background-image: url('../images/<?=$songlist['cover']?>')"></div>

                  <div class="text-danger" ><?=$songlist['name']?></div><div class="text-white"><?=$songlist['artiste']?></div>
              </div>

                    <!-- BOUTON RANDOM !-->
              <div class="d-flex align-items-center" >

                  <div class="mt-4 play p-3 ">
                    <i id="MusiqueRandom" class="fa-solid fa-shuffle fa-2xl" style="color: #ffffff;"></i>
                    <audio id="codeMusiqueRand" src="./music/songs/<?=$songlistrand['url']?>"></audio>
                    <?=$songlistrand['url']?>
                  </div>
                  #15c18d
                    <!-- BOUTON AVANT !-->
                  <div class="mt-4 play p-3">
                    <i class="fa-solid fa-backward fa-2xl" style="color: #ffffff;"></i>
                  </div>
               
                    <!-- BOUTON PLAY !-->

                    <div class="mt-4 play p-3 play"> 
                      <i id="playMusiquePlay" class="fa-solid fa-play fa-2xl" style="color: #ffffff;"> </i>
                      <audio id="codeMusiquePlay" src="./music/songs/<?=$songlist['url']?>"></audio>
                    </div> 

                    <!-- BOUTON PAUSE !-->

                    <div class="mt-4 play p-3 hiddenPLAY"> 
                      <i id="playMusiquePause" class="fa-regular fa-circle-pause fa-2xl" style="color: #ffffff;"></i>
                      <audio id="codeMusiquePause" src="./music/songs/<?=$songlist['url']?>"></audio>
                  </div> 
                    <!-- BOUTON APRES !-->
                  <div class="mt-4 play p-3">
                    <i class="fa-solid fa-forward fa-2xl" style="color: #ffffff;"></i>
                  </div>
              </div>      
            </section>

     



      

    
<script src="./js/index.js"></script>
<script src="https://kit.fontawesome.com/23471b5a81.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>