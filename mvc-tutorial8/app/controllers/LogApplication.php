<?php
/*
 * static purpose class LogApplication, for dividing tasks 
 */
namespace app\controllers;

class LogApplication {

  // do NOT implement a skeleton for the whole application: just to be called for LoginForm class which should use the static methods
   protected static String $username;
   protected static String $userpass;
   
   public static function getPath() {
      echo $_SERVER['REQUEST_URI'];

      return $_SERVER['REQUEST_URI'];
   }

   public static function getPostData() {
	   //   after, public static function getPostData($dataNames) {
      if ( (isset($_POST["email"])) && (isset($_POST["password"])) && (!empty($_POST["email"])) && (!empty($_POST["password"])) )
      {
		$username=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		echo " vous avez entre: ".$username;
		$userpass=isset($_POST['password']) ? $_POST['password'] : "none";
		//echo " vous avez entre: ".$userpass;
		echo 'Argon2i hash: ' . password_hash($userpass, PASSWORD_ARGON2ID);
			
		return ['username' => $username,
			'userpass' => $userpass];
       }
      else {
		return [];
      }
   }

   public static function runlogin() {
       require_once(ROOT."public/login.php");
   }
}

?>
