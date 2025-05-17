<?php
/*
 * Classe Retourner, gere le retour de l'emprunt
*/
namespace app\controller;

class Retourner extends ControllerExt {
    
   protected $error_msg;
   protected $title;

   public function getEmpActive() {
   // load the model of Class Emprunt and perform the query by user
      require_once(ROOT.'app//models//Model.php');
      require_once(ROOT.'app//models//Emprunt.php');
      $this->loadmodel('Emprunt');
      $this->model->username=$_SESSION['user'];
      $this->model->findIdUser();
      $result=$this->model->getEmpByUser();
      return $result;
   }
}
?> 
