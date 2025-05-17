<?php
/**
* Modele derivee de la classe de connexion a une base de donnees
*/
namespace app\models;

class Emprunt extends Model {
   //public static $id;
   public $idlivre;
   public $iduser;
   public $username;
   public $categlivre;

   // special methods
   public function findIdUser() {
      $sql='SELECT id, name FROM tbluser WHERE name=:username';
      $query = $this->_connection->prepare($sql);
      $query->bindParam('username', $username);
      $query->execute();
      return $query->fetchAll();
   }

   //
   public function getEmpByUser() {
	   $sql='SELECT tblemprunt.idlivre,tblemprunt.iduser,tblbook.title,tblbook.available FROM tblemprunt LEFT OUTER JOIN tblbook ON tblemprunt.idlivre = tblbook.bookid WHERE tblemprunt.iduser=:iduser';
	   $query = $this->_connexion->prepare($sql);
	   $query->bindParam('iduser', $iduser, \PDO::PARAM_INT);
	   $query->execute();
       return $query->fetchAll();
   }
   
   public function createEmp() {
	   $sql='INSERT INTO tblemprunt(idlivre, iduser, empdate) VALUES(?,?,?,?)';
	   $stmt = $this->_connection->prepare($sql);
	   try {
		   $stmt->beginTransaction();
		  // $stmt->execute( array($this->id, $this->idlivre,$this->iduser, now()) );
		   $stmt->execute( array( $this->idlivre,$this->iduser, now()) );

		   $stmt->commit();
		   $id = $stmt->lastInsertId();
		   return "success";
	   } catch (PDOException $e) {
		   $stmt->rollback();
		   print "Error!: :".$e->getMessage();
		   return "failed";
	   }
	 //  call 
   }

   public function getPeriodByCat(): int {
      $sql = "SELECT due_period FROM tblperiod WHERE categ=:categ";
      try {
	      $req = $this->_connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
	      $req->execute(['categ' => $categlivre]);
              $result = $req->fetchAll;
	      return $result["due_period"];
      } catch (PDOException $e) {
	   print "Error!: :".$e->getMessage();
	   return 0;
      }

   }
}
?>
