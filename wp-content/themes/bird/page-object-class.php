<?php
//Template Name: Object Oriented
 ?>

<h3>LEARNING OOP</h3><hr>
<style media="screen">
  .special {
    color: red;
    text-decoration: underline;
    font-weight: bold;
  }
</style>
<?php

//Define Class name called myClass
class myClass {
  public $var = "I am a class properties";

  public static $static_var = "I am a static variable";

  public function __construct() {
    echo 'The Object is created from ','<span class="special">', __CLASS__ ,'</span>' , '. <br>';
  }

  // public function __destruct() {
  //     echo 'The class "', __CLASS__, '" was destroyed.<br />';
  // }

  public function setProperty($newval) {
    $this->var = $newval."<br>";
  }

  public function getProperty() {
    return $this->var . "<br>";
  }

  public static function plusOne()
  {
      return self::$static_var .  "<br />";
  }

}

class myOtherClass extends myClass {
  public function __construct() {
    echo 'The Object is created from new ','<span class="special">', __CLASS__ ,'</span>' , '. <br>';
  }
}

//Creating the Object from myClass
// $obj = new myClass();
// echo $obj->getProperty();
// $obj->setProperty("This is another new paragraph");
// echo $obj->getProperty();

//CREATE TWO INSTANCES FROM SAME CLASS
// $obj = new myClass();
// $obj2 = new myClass();
//
// echo $obj->getProperty();
// echo $obj2->getProperty();
//
// echo "<br>";
// $obj->setProperty('I am a new paragraph for Object 1');
// $obj2->setProperty('I am a new paragraph for Object 2');
//
// echo $obj->getProperty();
// echo $obj2->getProperty();

//MAGIC CONSTRUCT

$obj = new myClass();
$obj = new myOtherClass();
echo $obj->plusOne();



















?>
