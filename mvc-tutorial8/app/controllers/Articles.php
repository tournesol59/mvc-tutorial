<?php 
/*
 * class ArticleS
 */
namespace app\controllers;

class Articles extends Controller {

  // fred: on va dabord fusionner les deux methodes suivantes index et indexById 
      public function index($params=[]) {  // perso: I am not sure for params
      // on instancie le modele 'Article' (sans s)
      //require_once(ROOT."app/models/Model.php");      
      //require_once(ROOT."app/models/Article.php"); // added app      
	      //echo "loadmodel ".ROOT."app/models/Article.php";
      $pattern = '/\w+/';
      if (isset($params[0])) {
        if ($params[0]==='all') {
         $this->loadmodel('Article');
         $this->model->table="tblbook";
         // stocke la liste des articles dans $articles
      
         $articles = $this->model->getAll(); 
         // on affiche les donnees
         // var_dump($articles); // provisoire
         $this->render('index', compact('articles'));
	}
	else if (preg_match($pattern, $params[0], $matches))
	{
	  $categ= $params[0];
          $this->loadmodel('Article', "name");
          // stocke la liste des articles correspondant a la category $cat
	  $articles = $this->model->getAllCateg($categ);
	  
	  echo " we are just before renderig the view ";
          $this->render("lire", ['articles' => $articles]);
	}
      }
   }

   public function indexById(int $id) {
	   // on instancie le modele article
      require_once(ROOT."app/models/Model.php");      
      require_once(ROOT."app/models/Article.php");
      $this->loadmodel('Article');
      $articles = $this->Article->getById($id);
      $this->render('index', compact('articles')); 
   }
   // perso: une deuxieme fonction on my own pour les articles decomposes par type ('category' R: roman, T: theatre, E: Essai, D: documentaire)
   public function lire(String $categ) {
	   // on instancie le modele 'Article' (sans s)
      require_once(ROOT."app/models/Model.php");      

      require_once(ROOT."app/models/Article.php"); 	   //      
      echo "loadmodel ".ROOT."app/models/".$this->model.".php";	   // 
 
      $this->loadmodel('Article', 'name');
      // stocke la liste des articles correspondant a la category $cat
      $articles = $this->Article->getAllCateg($categ);      
      // on affiche les donnees dans une page du sous dossier de view articles
      $this->render('lire', compact('articles'));
   }
}
?>
