<?php

class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $created_at;

    function __construct(){
    $this->setid($id , $name , $email , $password , $role , $created_at);
    $this->setname($name);
    $this->setemail($email); 
    $this->setpassword($password);
    $this->setrole($role);
    $this->setcreated_at($created_at);
    }

    function setid($id){ $this->id = $id; }
    function setname($name){ $this->name = $name; }
    function setemail($email){ $this->email = $email; }
    function setpassword($password){ $this->password = $password; }
    function setrole($role){ $this->role = $role; }
    function setcreated_at($created_at){ $this->created_at = $created_at; }


    function getid(){ return $this->id; }
    function getname(){ return $this->name; }
    function getemail(){ return $this->email; }
    function getpassword(){ return $this->password; }
    function getrole(){ return $this->role; }
    function getcreated_at(){ return $this->created_at; }


    function __destruct() { 
        echo "<p>User class instance destroyed.</p>"; 
        }

}
?>