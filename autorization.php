<?php
session_start();
class user
{
  public $login;
  public $password;
  function set_all(){
    $this->login=$_POST["login"];
    $this->password=$_POST["password"];
  }
  function get_all(){
      return "$this->login"."$this->password";
  }
  function check_all(){
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
          $ar = array('a' => "ohyenno",'b'=>$this->login);
          echo json_encode($ar);
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
  function isset(){
    if(isset($_COOKIE['login']))
    {
      $ar = array('a' => "ohyenno",'b'=>$this->login);
      echo json_encode($ar);
    }
    else {
      $this->check_all();
    }
  }
  function exit()
  {
    unset($_COOKIE['login']);
  }
}

$a = new user();
$a->set_all();
$a->isset();
if ($_POST['exit']=="exit") {
  $a->exit();
  $_POST['exit']='';
}

?>
