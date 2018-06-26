<?php
//Template Name: Javascript Template
 ?>
<?php get_header(); ?>

<h1  style="text-decoration:underline;">Javascript</h1>

<p>The total is : <span id="sum"></span> </p>
<p>The highest number is : <span id="highest"></span> </p>

<hr><h2>OOP</h2>
<p id="object"></p>

<hr><h2>Error Handlers</h2>
<p id="errmsg"></p>



<script type="text/javascript">

//SUM
var points = [1, 20, 30];
function getSum(total, num) {
  return total + num;
}

//Highest and Lowest (b -a)
points.sort(function(a, b){return a - b });

document.getElementById('sum').innerHTML = points.reduce(getSum);
document.getElementById('highest').innerHTML = points[0];


//Error Handlers Try, Catch, Finally
function arrayFun() {
var fruits = ["Apple", " Banana", " Orange"];
document.write(fruits);
}

try {
  arrayFun();
} catch(err) {
  document.getElementById('errmsg').innerHTML = err.message;

}

//Javascript OOP
var person = {
  firstname: "Ishwor",
  lastname: "Khatri",
  age: 19,
  id: 4323,
  fullname: function() {
    return this.firstname + " " + this.lastname;
  }
}
document.getElementById('object').innerHTML = person.fullname();

var human = {
  firstname: "Ishwor",
  lastname: "khatri",
  ID: 1,
  fullname: function() {
    return this.firstname + " " + this.lastname;
  }
}

// document.getElementById('demo').innerHTML = human.fullname();


//OOP CONCEPT
// Constructor function for Person objects
function Person(first, last, age, eye, nationality) {
  this.firstname = first;
  this.lastname = last;
  this.age = age;
  this.eye = eye;
}

Person.prototype.nationality = "Nepali"

Person.prototype.fullname = function() {
  return this.firstname + " " + this.lastname + ", " + this.age + " year's old." + " He/She is a " + this.nationality + ".";
}

// Create a Person object
var myname = new Person("Ishwor", "Khatri", 26, "Black");
var sharmila = new Person("Sharmila", "Khatri", 25, "Black");
document.getElementById('demo').innerHTML = myname.fullname();
document.getElementById('demo2').innerHTML = sharmila.fullname();


//Another Way of learn OOP
//OOP MASSIVE EXERCISE
var customer = {
  name: "Tom Smith",
  speak: function() {
    return "My name is " + this.name;
  },
  address: {
    street: "123 Main St",
    city: "Colorodo Spring",
    state: "Colorado"
  }
}

document.write(customer.speak() + "</br>");
document.write(customer.address.street + "</br>");
customer.address.country = "USA";
document.write(customer.address.country + "</br>");

document.write("<hr></br>");
//Construction function to create the object
function Person(name, address) {
  this.name = name;
  this.address = address;
  this.info = function(){
    return "My name is " + this.name + " and I live in " + this.address;
  }
}

//Create the object using above construction
var ram = new Person("Ram Smith", "123 Main Dr");
document.write(ram.info() + "</br>");

//Change the same object value using funtion
function changeName(person){
  person.name = "Shyam";
}
changeName(ram);
document.write("Ram Smith is became a " + ram.name);

document.write("<hr></br>");
//Prototype

//Construction
function Mammal(name) {
  this.name = name;
  this.getInfro = function(){
    return "This mammals name is " + this.name;
  }
}

//add additional properties and methods to Mammal Construction
Mammal.prototype.sound = "'Grrrrr'";
Mammal.prototype.makesound = function(){
  return this.name + " says " + this.sound;
}

//Create the object and output the result
var Grover = new Mammal('Grover');
document.write(Grover.makesound() + "</br>");









</script>


<?php get_footer(); ?>
