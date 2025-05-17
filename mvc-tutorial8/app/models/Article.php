<?php
/**
 *  instance
 */
namespace app\models;

class Article extends Model {

   public function __construct() {
      // definir table par defaut dans ce modele
      $this->table = "tblbook";
      $this->id = 1;
      // nous ouvrons la connexion a la BD
      //$this->getConnection();
   }

   // methode getOne et getAll() heritees de la classe abstraite model
   // if you want to bypass the connection to test render view only, use follow
/*
 *
   public function getOne() {
      if ($this->table==="tblbook") {
         if ($id===1) {
		 return ['id' => 1,
                    'title' => 'Harry Potter at the School of Wizard',
		    'author' => 'JK Rowling',
		    'pubdate' => '1997-12-12',
	            'category' => 'R'];
         }
      }
   }
   public function getAll() {
      if ($this->table==="tblbook") {
        return [['id' => 1,
                    'title' => 'Harry Potter at the School of Wizard',
		    'author' => 'JK Rowling',
		    'pubdate' => '1997-12-12',
	            'category' => 'R'],
                ['id' => 2,
                    'title' => 'Harry Potter and the Chamber of Secrets',
		    'author' => 'JK Rowling',
		    'pubdate' => '1998-12-12',
		    'category' => 'R'],
                ['id' => 3,
                    'title' => 'Harry 5',
		    'author' => 'W. Shakespeare',
		    'pubdate' => '1565',
	            'category' => 'T']];
      }
   }
 */
   public function setId(int $id) {
      $this->id = $id;
   }

   public function getById(int $id) {
      $this->setId($id);
      $items=$this-getAll();

      if ($this->table==="tblbook") {
         foreach($items as $item) {
	    if ($item['id']===$id) {
                return $item;
	    }
         }
      }
   }

   public function getAllCateg(string $categ) {
      $result=[];
      $items=$this->getAll();
      
      if ($this->table==="tblbook") {
	 foreach ($items as $item) {
	    if ($item['category']===$categ) {
               array_push($result, $item);
	    }
	 }
      }
      /*
      echo "<pre>";
           echo "result query ".$categ;
	   var_dump($result);
      echo "</pre>";
       */
      return $result;
   }
   
}
?>
