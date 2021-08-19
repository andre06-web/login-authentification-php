<?php
 session_start();

 // define variables and set to empty values
 $login = $pass = $valider = "" ;

 $login = test_input($_POST["login"]);

 //$login = $_POST["login"];
 $pass = $_POST["pass"];
 $valider = $_POST["valider"];

 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strtolower($data);
  return $data;
}

include('connect.php');

$reponse = $bdd->query('SELECT pseudo,password FROM authentification');

while ($donnees = $reponse->fetch())
{
    
   // echo $donnees['pseudo'] . '<br /><br />';
    
   // echo $donnees['password'] . '<br />';
    
    $pseudo = $donnees['pseudo'];
    
    $secret = $donnees['password'];
}

$reponse->closeCursor();
    
  // $hash = password_hash($pass, PASSWORD_DEFAULT); // a utiliser si je veux hasher et stocker le mdp en bdd

   $erreur="";
   if(isset($valider)){
  if (password_verify($pass, $secret) && $login==$pseudo) {

         $_SESSION["autoriser"]="oui";
         header("location:session.php");
      }
      else
         $erreur="Mauvais login ou mot de passe !";
   }
    
   
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
      </style>
   </head>
   <body onLoad="document.fo.login.focus()">
      <h1>Authentification</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text"  name="login" placeholder="Login" /><br />
         <input type="password" name="pass" placeholder="Mot de passe" /><br />
         <input type="submit" name="valider" value="S'authentifier" />
      </form>
   </body>

</html>