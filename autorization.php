<?php
session_start();
class user
{
  public $login;
  public $password;
  function set_all(){//setting all fields
    $this->login=$_POST["login"];
    $this->password=$_POST["password"];
  }
  function get_all(){
      return "$this->login"."$this->password";
  }
  function check_all(){//checking login and password
    $flag = false;
    $xml=simplexml_load_file("test1.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books) {
      $login1 = $books->login;
      if($this->login==$login1){
        $flag = true;
        $salt=$books->salt;
        $pass=md5($this->password.$salt);
        if($pass==$books->password)
        {
          setcookie("login", $this->login, time()+60*60*24*30);
        }
        else {
          $arv = array('a' => "Wrong password");
          echo json_encode($arv);
        }
      }
    }
    if($flag==false){
      $ard = array('a' => "Wrong login");
      echo json_encode($ard);
    }
  }
  function isset(){//creating cookie if user is loged in
    if(isset($_COOKIE['login']))
    {
      $ar = array('a' => "success");
      echo json_encode($ar);
    }
    else {
      $this->check_all();
    }
  }
}

$a = new user();
$a->set_all();
$a->isset();

?>
