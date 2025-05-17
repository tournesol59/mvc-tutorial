<?php 
/*
 * class MainS
 */
namespace app\controllers;

class Mains extends Controller {

	// fred: juste une classe pour tester la connexion bd
	 
    public function index($params=[]) {
	      
      	      // perso: I am not sure for params
      // on instancie le modele 'User' (sans s)
      //require_once(ROOT."app/models/Model.php");      
      //require_once(ROOT."app/models/User.php"); // added app      
	      //echo "loadmodel ".ROOT."app/models/Article.php";
      $pattern = '/\w+/';
      if (isset($params[0])) {
        if ($params[0]==='all') {
         $this->loadmodel('User');
         $this->model->table="tbluser";
         // stocke la liste des users dans $users
      
         $users = $this->model->getAll(); 
         // on affiche les donnees
         // var_dump($users); // provisoire
         $this->render('index', compact('users'));
	}
      }
   }

}
?>
