<?php
class register
{
  public $login;
  public $password;
  public $confirm_password;
  public $email;
  public $name;
  static function generateSalt() {
    $salt = '';
    $length = rand(5,10);
    for($i=0; $i<$length; $i++) {
         $salt .= chr(rand(33,126));
    }
    return $salt;
  }
  function not_empty(){
    if($this->login!=''&&$this->password!=''&&$this->confirm_password!=''&&$this->email!=''&&$this->name!=''){return true;}
    else {return false;}
  }
  function create(){
    $salt = register::generateSalt();
    $pass=md5($this->password.$salt);
    $xml = new domDocument('1.0','utf-8');
    $xml->load('test1.xml');
    $root = $xml->documentElement;
    $user = $xml->createElement("info");
      $login = $xml->createElement("login", $this->login);
      $password = $xml->createElement("password", $pass);
      $email = $xml->createElement("email", $this->email);
      $name = $xml->createElement("name", $this->name);
      $salt= $xml->createElement("salt", $salt);
      $user->appendChild($login);
      $user->appendChild($password);
      $user->appendChild($email);
      $user->appendChild($name);
      $user->appendChild($salt);
    $root->appendChild($user);
    $xml->formatOutput = true;
    $test1 = $xml->saveXML();
    $xml->save('test1.xml');
  }
  function set_all(){
    $this->login=$_POST["login"];
    $this->password=$_POST["password"];
    $this->confirm_password=$_POST["confirm_password"];
    $this->email=$_POST["email"];
    $this->name=$_POST["name"];
  }
  function get_all(){
    return "$this->login"."$this->password"."$this->confirm_password"."$this->email"."$this->name";
  }
  function check_password(){
    if($this->password==$this->confirm_password){return true;}
    else {return false;}
  }
  function check_login(){
    $flag=true;
    $xml=simplexml_load_file("test1.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books) {
      $login1 = $books->login;
      if($this->login==$login1){$flag=false;}
    }
    if($flag){return true;}
    else {return false;}
  }
  function check_email(){
    $flag=true;
    $xml=simplexml_load_file("test1.xml") or die("Error: Cannot create object");
    foreach($xml->children() as $books) {
      $email1 = $books->email;
      if($this->email==$email1){$flag=false;}
    }
    if($flag){return true;}
    else {return false;}
  }
  function create_new_user(){
    if($this->not_empty()){
      if($this->check_password()){
        if($this->check_login()){
          if($this->check_email()){
            $this->create();
            $a = array('a' => "success");
            echo json_encode($a);
          }
          else{
            $rr = array('a' => "such email is already taken");
            echo json_encode($rr);
          }
        }
        else {
          $ar = array('a' => "such login is already taken");
          echo json_encode($ar);
        }
      }
      else{
        $ar = array('a' => "password and confirm_password are not equal");
        echo json_encode($ar);
      }
    }
    else{
      $ar = array('a' => "there are empty fields");
      echo json_encode($ar);
    }
  }
}

$a = new register();
$a->set_all();
$b=$a->create_new_user();

?>
