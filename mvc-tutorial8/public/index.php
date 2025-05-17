<?php
/**
 * super method to instanciate the controleurs and models from the lURi
 */
session_start();
// info d'URL generated from the server
// we generate a constant filled with the public root path of the project
define('ROOT', str_replace('public\index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('DBNAME', 'livresdb'); // can be without db suffixes in some platform
   require ROOT.'app/bootstrap.php'; // see from another tutorial, after composer install
   require_once(ROOT.'app/models/Model.php');
   require_once(ROOT.'app/controllers/Controller.php');
   //if ($params[0]==='login') {
   //   require_once(ROOT.'public/login.php');
   //}
   // normally we proceed a GET request login.php?p=articlescontrol
   $params = explode('/', $_GET['p']);
   var_dump($params);
 //  $params = explode('/', $_SERVER['REQUEST_URI']);
   
   if (isset($params[0])) {
	   echo "param0 is ".$params[0]." ";
   }
   if (isset($params[1])) {
	   echo "param1 is ".$params[1]." ";
   }
   if (isset($_SESSION["user"]["name"])) {
       echo " user is ".$_SESSION["user"]["name"];
   }	   
   // another mean to get the URI is:*
   //echo "request uri is ".$_SERVER['REQUEST_URI'];
   //
   //then follows cannot be accessed if you dont have login previously
?>
<?php if (isset($_SESSION["user"]["name"])) :  ?>
<?php
   // manage the URL params: eg URI app/controller/method becomes login.php?p=controller/method, in the following we denotes the first param 'controller', the second 'method'.
   // si au moins un param existe
if ($params[0] != "") {
	// et si ce param est sous la forme "<controllername>control"
        echo " valid ".$params[0];
    $pattern="/.+(control)/";
        //preg_match($pattern, $params[0], $matches, PREG_OFFSET_CAPTURE);
	//	echo " the param matching was ".$matches[0];

    if (preg_match($pattern, $params[0], $matches, PREG_OFFSET_CAPTURE)) {
		var_dump($matches);
		// we only get the first part of the name
		$controller = str_replace('control', '', $matches[0][0]); 
		$controller = ucfirst($controller);
		// test on screen to check match is good
		echo ROOT.'app/controllers/'.$controller.'.php';

			// we save the second param into $action
		$action = isset($params[1]) ? $params[1] : 'index';
		
		/* instanciate the controller
		 */ 
		require_once(ROOT.'app\\controllers\\'.$controller.'.php'); // Articles.php default
		$controller = "\\app\\controllers\\".$controller;
		$controller = new $controller();
		if (method_exists($controller, $action)) {
			// we cancel the first 2 params: controller, action
			   unset($params[0]);
			   unset($params[1]); 
	   // we call the method $action of the controller
	   //$controller->$action();  // prefer user_func with array as params
		   echo "before rendering the view ".$params[2];
		   call_user_func_array([$controller, $action], $params);
		}
	/*
		// for debug we instanciate manually
		require_once(ROOT.'app/controllers/Articles.php');
		$controller = new \app\controllers\Articles();
		// $controller->index();
		$controller->indexCategory('R');
	*/
		echo " we have rendered the view";
    }
    else if ($params[0]==="login") { // 
    	    // re route to another route as std controller, eg login page (priority)
	    echo " we are going to login part";
	//LogApplication::runlogin();

            require_once(ROOT."public/login.php");
    } // end preg_match test
     
  } else {
         http_response_code(404);
	 echo " La page recherchee nexiste pas";
	// si aucun param n est defini
      require_once(ROOT.'app/controllers/Mains.php');
      // on instancie le controleur
      $controller = new \app\controllers\Mains();
      // on appelle la methode index
      $controller->index();

  }
 
?>
<?php else: ?>
<?php
		  echo '<pre>';
		  echo ROOT."public/login.php";
		  echo '</pre>';
          require_once(ROOT."public/login.php");
?>
<?php endif; ?>

