<?php
class register
{
  public $login;
  public $password;
  public $confirm_password;
  public $email;
  public $name;
  static function create(){
    $xml = new DomDocument("1.0","UTF-8");
    $xml->load('users.xml');
    $root = $xml->getElementByTagName("root")->item(0);
    $user = $xml->createElement("user");
      $login = $xml->createElement("login", $this->login);
      $password = $xml->createElement("password", $this->password);
      $email = $xml->createElement("email", $this->email);
      $name = $xml->createElement("name", $this->name);
      $user->appendChild($login);
      $user->appendChild($password);
      $user->appendChild($email);
      $user->appendChild($name);
    $root->appendChild($user);
    $xml->save('users.xml');
    $arr = array('a' => "kek");
    echo json_encode($arr);
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
  function check_login(){
    $flag=true;
    $dom->load("users.xml");
    $root = $dom->documentElement;
    $childs = $root->childNodes;
    for ($i = 0; $i < $childs->length; $i++) {
      $user = $childs->item($i); // Получаем следующий элемент из NodeList
      $lp = $user->childNodes; // Получаем дочерние элементы у узла "user"
      $login1 = $lp->item(0)->nodeValue; // Получаем значение узла "login"
      if($this->login==$login1){$flag=false;}
    }
    if($flag){return true;}
    else {return false;}
  }
  function check_email()
  {
    $flag=true;
    $dom->load("users.xml");
    $root = $dom->documentElement;
    $childs = $root->childNodes;
    for ($i = 0; $i < $childs->length; $i++) {
      $user = $childs->item($i); // Получаем следующий элемент из NodeList
      $lp = $user->childNodes; // Получаем дочерние элементы у узла "user"
      $email1 = $lp->item(2)->nodeValue; // Получаем значение узла "login"
      if($this->email==$email1){$flag=false;}
    }
    if($flag){return true;}
    else {return false;}
  }
  function create_new_user(){
    if($this->check_login()){
      if($this->check_email()){
        $this->create();
        $arr = array('a' => "success");
        echo json_encode($arr);
      }
      else{
        $arr = array('a' => "such email is already exist");
        echo json_encode($arr);
      }
    }
    else {
      $arr = array('a' => "such login is already exist");
      echo json_encode($arr);
    }
  }
}
$a = new register();
$a->set_all();
$a->create();
?>
