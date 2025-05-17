<?php
/**
 *Classe controller 
 */
namespace app\controllers;

abstract class ControllerExt {
   public $model;
   public $modelext;

   public function loadmodel(String $model) {
 // we look for the file corresp. to the model we want
 // see model Article.php
	   // perso: I needed to prefix the namespace for getting this working
      require_once(ROOT."app/models/Emprunt.php");
      $namemodel = '\\app\\models\\' . $model;  // fred added this trick
      $this->model= new $namemodel(); //fred: add $name for queries "where"
      $this->model->getConnection();
   }
	 
   public function index($params=[]) {
      echo "index outputs the data from model";
   }
   
   public function loadmodelext(String $model) {
 // for this 'Extended' class of controller, we need a second model instance
 // for example the 'Emprunter' class needs both a "livre" and a "emprunt" model
	   // 
      require_once(ROOT."app/models/Livre.php");
      $namemodel = '\\app\\models\\' . $model;  // fred added this trick
      $this->model= new $namemodel(); //fred: add $name for queries "where"
      $this->model->getConnection();
   }
	 

   // The following method enables to load all the views, whichever the controller which calls it. For getting this we use the function get_class which returns the specialized controller call instance
   public function render(string $fichier, array $data=[]) {
      // from an array decumpose it to variables
      extract($data);
      // set the path and include the view file
      $nameclass=str_replace('app\\controllers\\', '',strtolower(get_class($this)) );
      echo ROOT.'app/views/'.$nameclass.'/'.$fichier.'.php';
      //      require_once("C:\\Users\\frede\\phpStorm\\mvc-tutorial\\app\\views\\articles\\lire.php");
       require_once(ROOT.'app/views/'.$nameclass.'/'.$fichier.'.php');
   }
}
?>
