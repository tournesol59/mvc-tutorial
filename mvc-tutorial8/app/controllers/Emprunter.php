<?php
// fred: this class has two models
/*
 * class Emprunter
 */
namespace app\controllers;

class Emprunter extends ControllerExt {
   
   protected $error_msg;
   protected $title;

   // this function shall verify that a 'livre' is not already borrowed
   public function verify_isavailable() {

       require_once(ROOT."app/models/Livre.php");
       $this->loadmodelext("Livre");

       $this->modelext->id=$_SESSION['user']['id']; // fred: may be an error here, test and if confirmed replace $_SESSION['user']['id'] by $_SESSION['user']['reserveid']
       echo '<pre>';
       echo 'id user transmis';
       echo $_SESSION['user']['id'];
       echo '</pre>';

	   $result = $this->modelext->getOne();
	   // we want to get the title for rendering
	   $this->title=isset($result["title"])? $result["title"] : "notfound";
	   return $result["available"];
   }

   public function getEmpActive() {
       require_once(ROOT."app/models/Emprunt.php");
       $this->loadmodel("Emprunt");
       $this->model->iduser=$_SESSION["user"]["id"];
       $result=$this->model->getEmpByUser();
       return $result;
   }

   // this function shall save the 'emprunt' in the database
   public function saveemprunt() {
       require_once(ROOT."app/models/Emprunt.php");
       $this->loadmodel("Emprunt");

       if ($this->verify_isavailable()===true) {
	      $this->model->idlivre=$_SESSION['user']['reserveid'];
          $this->model->iduser=$_SESSION['user']['id'];		   
          $this->error_msg=$this->model->createEmp();
		  // $_SESSION['user']['isempactivated']=1;
	   }
	   else {
		  $this->error_msg="notavailable";
	   }
	   // prepare arguments for the view
	   $this->render('emprunter', ['title'=>$this->title, 
		   'error_msg'=>$this->error_msg] );
   }

   public function findActiveEmprunt(int $idlivre) {
	   // function to get the emprunt
       require_once(ROOT."app/models/Emprunt.php");
       $this->loadmodel("Emprunt");
       $this->model->idlivre=$idlivre;
       $result=$this->model->getEmpByLivre();
       $activres=[];
       foreach($result as $res) {
	   if ($res['isactive']=true) {
	       $this->modelext->idlivre = $res['idlivre'];
	       $livreres = $this->modelext->getOne(); // reuse code above to find corresp title
	       $activeres=['idlivre'=>$res['idlivre'], 'title' => $livreres['title']];
               break;
	       }
       }
       return $activeres;
   }
}
   
?>
