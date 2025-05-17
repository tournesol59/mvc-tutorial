<?php

$statusReserve = "";
$errorMessage="";
session_start();
if (!defined('ROOT')) {
   define('ROOT', str_replace('app\forms\user_emprunt.php', '', $_SERVER['SCRIPT_FILENAME']));
}
echo '<pre>';
echo " ".ROOT;
echo " ".$_POST["idlivre"];
echo '</pre>';// this condition prevents to unintentionally skip the form

require_once(ROOT."app\controllers\EmpApplication.php");
$postData = EmpApplication::getParam();
 	echo '<pre>';
        echo " ".$postData["idlivre"];
	echo '</pre>';
if (isset($postData["idlivre"])) { 
 	echo '<pre>';
        echo " ".$postData["title"];
	echo '</pre>';
  $statusReserve=EmpApplication::$statusReserve;
  $errorMessage=EmpApplication::$errorMessage;
  if ($statusReserve="checkingtitle") { 	
	$_SESSION["user"]["reserveid"]=$postData["idlivre"]; // waiting for validating demand if no loan already active
	$_SESSION["user"]["isempactivated"]=0;
	// the following is only a further step of validation of corresp. (id <-> title
	require_once(ROOT."app/controllers/Controller.php");
	require_once(ROOT."app/controllers/Livres.php");
	$controllivre=new \app\controllers\Livres();
	$livres=$controllivre->checktitle($postData['title']);
	if (isset($livres)) {
	   $_SESSION["user"]["reservetitle"]=$livres[0]["title"];
	   $_SESSION["user"]["reserveid"]=$livres[0]["bookid"]; // correction here
	}
	// inquire if the current book with title is not already owned by the user:
        require_once(ROOT."app/controllers/ControllerExt.php");
	require_once(ROOT."app/controllers/Emprunter.php");
	require_once(ROOT."app/models/Emprunt.php");
	$controlemprunt= new \app\controllers\Emprunter();
	if (isset($livres)) {
	   $resemprunt = $controlemprunt->getEmpActive();
	   // return an array([idlivre, iduser, title, isavail])
	   if (isset($resemprunt)) {
	      $_SESSION["user"]["reservestatus"]="onloan";
	   }
	}

  }
}
?>

<?php if (!isset($_SESSION["user"]["reservetitle"])) : ?>
<form action="user_emprunt.php" method="POST">
	<!-- IMPORTANTE modif donc: page auto appelee -->
	<?php if (isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
	</div>
    <?php endif ; ?>
  <h1>Reservez un livre</h1>
  <div class="mb-3">
    <label for="text" class="form-label">Titre</label>
    <input type="text" class="form-control" id="title" name="titlename" >
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">numero id</label>
    <input type="text" class="form-control" id="idlivre" name="idlivre">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>	
<?php elseif (!isset($_SESSION["user"]["reservestatus"])) : ?>
   <div class="alert alert-success" role="alert">
   <h2>Le livre que vous avez choisi</h2>
   <p> <td><?= $_SESSION["user"]["reservetitle"] ?></p>
   <a href="index.php?p=empruntercontrol/saveemprunt/<?=$_SESSION["user"]["reservetitle"] ?>">reserver le livre (titre)<?=$_SESSION["user"]["reservetitle"] ?></a>
<br>
   <a href="index.php?p=empruntercontrol/saveemprunt/<?=$_SESSION["user"]["reserveid"] ?>">reserver le livre (id)<?=$_SESSION["user"]["reserveid"] ?></a>

   <?php unset($_SESSION["user"]["reservetitle"]) //free the session param ?>   
   </div>
<?php else : ?>
   <div class="alert alert-success" role="alert">
   <h2>Vous etes deja l emprunteur de ce livre</h2>
   <p> <td><?= $_SESSION["user"]["reservetitle"] ?></p>
   <a href="index.php?p=retournercontrol/dorelease/<?=$_SESSION["user"]["reservetitle"] ?>">retourner ce livre (titre)<?=$_SESSION["user"]["reservetitle"] ?></a>
   </div>

<?php endif; ?>   
