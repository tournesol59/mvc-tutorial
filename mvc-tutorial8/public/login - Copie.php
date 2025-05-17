<?php
$postData = $_POST;
$statusUser = "";
$errorMessage="";
session_start();
if (!defined('ROOT')) {
   define('ROOT', str_replace('public\login.php', '', $_SERVER['SCRIPT_FILENAME']));
}
echo '<pre>';
echo " ".ROOT;
echo '</pre>';
if (!isset($postData['email'])) {
   $statusUser = "error";
   $errorMessage="Le formulaire email et password doit etre rempli pour chaque champ";
}
else {
   $statusUser = "";
   $errorMessage="";	
   $username=isset($postData['email']) ? $postData['email'] : "none";
   echo " vous avez entre: ".$username;
   $userpass=isset($postData['password']) ? $postData['password'] : "none";
   echo " vous avez entre: ".$userpass;   
   require_once(ROOT.'app/models/Model.php');
   require_once(ROOT.'app/models/User.php');

   $usermodel = new app\models\User();
   $user = $usermodel->getOneByName($username);
   if ($user['pass']===$userpass) {
      // we save in $_SESSION the infos concerning user
      $_SESSION["user"]=[
	 "name" => $user["name"]]; // attention, cest un email en fait, mais le champ de la BDD est appele "name"
	   
      $loggedUser=['name' => $user['name']];
      $statusUser="connected";
      var_dump($_SESSION["user"]);
      
   }
   else {
           $statusUser="notfound";
	   $errorMessage="invalid name or password";
   }

}    // ON COURT CIRCUITE UN PEU POUR TESTER LA PARTIE MODEL
     // if (!isset($_SESSION["user"])) {
     //     $_SESSION["user"]=["name" => "laurence.peugny@gmail.com"]; // attention, cest un email en fait
     // }
?>
<?php if (!isset($_SESSION["user"])) : ?>
<form action="login.php" method="POST">
	<!-- IMPORTANTE modif donc: page auto appelee -->
	<?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
	    </div>
        <?php endif ; ?>
  <h1>Contactez nous</h1>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php else : ?>
   <div class="alert alert-success" role="alert">
      <p>Bonjour <?php if (isset($_SESSION["user"]['name'])) echo $_SESSION["user"]['name']; ?> et bienvenue sur le site !</p>
      <a href="profileuser.php">Votre page pour demarrer une recherche</a>
<?php endif; ?>
