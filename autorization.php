<?php
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
/*  function check_all(){
    $flag;
    $xml=simplexml_load_file("test1.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books) {
      $login1 = $books->login;
      if($this->login==$login1){
        $pass=$this->password;
        $salt=$books->salt;
        $passh=md5($pass.$salt)
        if($passh==$books->password)
        {
          $ar = array('a' => "ohyenno");
          echo json_encode($ar);
        }
      }
    }
    if($flag==false){return false;}
    else {return $flag;}
  }*/

}

$a = new user();
$a->set_all();
//$a->check_all();
$arc = array('b' => "ohyenno");
echo json_encode($arc);
?>
