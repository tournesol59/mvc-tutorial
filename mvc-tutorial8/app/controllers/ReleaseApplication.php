<?php
class ReleaseApplication {
	public static String $statusReturn="";
	public static String $errorMessage="";
	
	public static function getParam() {
		if ((isset($_POST['idlivre']))) {
			$statusReturn="findbyid";
			$reserveid=$_POST['idlivre'];  // LIVRE id, just to enable a searcg by USER id
			//$reservetitle=$_POST['title']; // not used unlike in Emp
			return [['idlivre' => $reserveid]];
		}
		else {
			$statusReturn="notvalidparam";
			$errorMessage="error, a valid identifier must be entered";
			return [];
		}
	}
	
}
?>
