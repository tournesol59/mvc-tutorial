<?
// just an empty formular (for the moment) for filling the session an render (with link) with the status of the Emprunt (which could be returned with a link after)
$statusReturn = "";
$errorMessage="";
session_start();
if (!defined('ROOT')) {
	define('ROOT', str_replace('app/forms/user_release.php', '', $_SERVER['SCRIPT_FILENAME']));
}
require_once(ROOT."app/controllers/ReleaseApplication.php");
$postData = ReleaseApplication::getParam();
$statusReturn=ReleaseApplication::statusReturn;
$errorMessage=ReleaseApplication::errorMessage;
if ($statusReturn="findbyid") {
	$_SESSION["user"]["activeempid"]=$postData["idlivre"]; // IMPORTANT, not the same as isempactivated because can be set after browser re-login

	require_once(ROOT."app/controllers/Emprunt.php");

//	$controlemp=new \app\controllers\Emprunter();
	$controlemp=new \app\controllers\Retourner(); // new class, it will be clearer
	$emprunt=$controlemp->findActiveEmprunt($postData['idlivre']);
	if (!isset($emprunt)) {
		$statusReturn = "no-active-emp";
	}
	else {
		$statusReturn = "emp-found";
		$_SESSION["user"]["activeempid"]=$emprunt["idlivre"];
	}
}
?>

<?php if (!isset($_SESSION["user"]["activeempid"])) : ?>
<form action="user_release.php" method="POST">
	<!-- IMPORTANTE modif donc: page auto appelee -->
	<?php if (isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
	    </div>
    <?php endif ; ?>
  <h1>Consulter vos Articles empruntes</h1>
 <div class="mb-3">
    <label for="text" class="form-label">numero id</label>
    <input type="text" class="form-control" id="idlivre" name="idlivre">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>	
<?php else : ?>
   <div class="alert alert-success" role="alert">
   <h2>Le livre que vous avez emprunte</h2>
   <p> <td><?= $livre['title'] ?></p>
   <!-- p --> <td><!-- ?= $_SESSION["user"]["reservetitle"] ? --><!-- /p -->
   <a href="index.php?p=retournercontrol/dorelease/<?=$_SESSION["user"]["reservetitle"] ?>">retourner ce livre (titre)<?=$_SESSION["user"]["reservetitle"] ?></a>

<!-- ici un lien vers index.php -->   
   </div>
<?php endif; ?>  
