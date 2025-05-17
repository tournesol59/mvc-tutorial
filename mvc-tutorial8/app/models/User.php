<?php
/**
 *  instance
 */
namespace app\models;

class User extends Model {

 public function __construct() {
   $this->table="tbluser";
   $id = 1;
} 

public function getOneByName($name) {
    $usermatch=[];
    $this->getConnection();
    if ($this->table==="tbluser") {
	 $users = $this->getAll();
	 foreach ($users as $user) {
	    if ($user['email']===$name) {
	       $usermatch = ['id' => $user['id'],
                    'name' => $user['email'],  // careful, at this current state it is ok
		    'pass' => $user['pass']];
            }
	 }
    }
    //var_dump($usermatch);
    return $usermatch;
 }

/*
  public function getAll() {
      if ($this->table==="tbluser") {
        return [['id' => 1,
                 'name' => 'laurence',
		 'passwd' => 'isabel'],
                ['id' => 2,
                 'name' => 'delphine',
                 'passwd' => 'melanie']];
      }
   }
 */
}

