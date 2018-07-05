<?php
//Template Name: Javascript Template
 ?>
<?php get_header(); ?>

<script type="text/javascript">

"use strict";

//Set some variables :::
const line = "<hr>";
const lineBreak = "<br>";

//SUM
var points = [1, 20, 30];
function getSum(total, num) {
  return total + num;
}

//Highest and Lowest (b -a)
points.sort(function(a, b){return a - b });
document.write( points.reduce(getSum) + lineBreak );
document.write( points[0] + lineBreak + line );


//OOP CONCEPT
document.write("<h2>Javascript Advance</h2>" + line + line );


/**
PORTOTYPE
*/

//Create a construction
function Employee(name){
  this.name = name;
}

//Add the function using prototype
Employee.prototype.getName = function(){
  return this.name.toUpperCase();

}

//Create an object by using above construction
var EmployeeOne = new Employee('Josh');
var EmployeeTwo = new Employee('Don');

//Display an object
document.write(EmployeeOne.getName() + lineBreak);
document.write(EmployeeTwo.getName() + lineBreak);

document.write( lineBreak + line + line );
/**
INHERITANCE
*/

//create the base construction
function Worker(name) {
  this.name = name;
}

//prototype to get name
Worker.prototype.getName = function(){
  return this.name;
}

//prototype to get name length
Worker.prototype.getNameLength = function(){
  return this.name.length;
}

//Add Another function or construction
function PermanentWorker(salary){
   this.salary = salary;
}

//Create an Object by using base construction
var WorkerOne = new Worker("Tigerlol");

//Now INHERITANCE the PermanentWorker construction with base Worker
PermanentWorker.prototype = WorkerOne;

//Create an new object by using PermanentWorker because it's already INHERITANCE with Worker construction to access getName function
var PermanentWorerOne = new PermanentWorker(50000);
document.write(PermanentWorerOne.getName() + lineBreak); //Get the Name
document.write("The Name Length Is : " + PermanentWorerOne.getNameLength()); //Get the Name Length

document.write( lineBreak + line + line );
//COOKIES

document.write("<button onclick='setCookie();'>SetCookie</button>" + lineBreak);

//set the cookie
function setCookie(){
  document.cookie = "CookieName = CookieValue";
}

//Read the cookies
var readCookie = document.cookie;

if(readCookie){
  document.write("Cookie has been set !");
}else {
  document.write("Cookie is not set yet!");
}

document.write( lineBreak + line + line );
//JSON

var employees = {
  "Firstname":"Krishna",
  "Lastname":"Khatri",
  "age":30,
  "Degree":"Associate",
};
document.write(employees.Firstname + " " + employees.Lastname + " " + employees.age);
document.write( lineBreak );

//Json Object
var friends = {
  "Mark": {
    "Firstname":"Mark",
    "Lastname":"Silton",
    "Gender":"Male",
  },
  "Preety": {
    "Firstname":"Preety",
    "Lastname":"Sohagan",
    "Gender":"Female",
  },
};
document.write(friends.Mark.Firstname + " is a " + friends.Mark.Gender + lineBreak);
document.write(friends.Preety.Firstname + " is a " + friends.Preety.Gender + lineBreak);

document.write( lineBreak + line + line );
//Json Array Store
var employeesName= [
    {
        "firstName": "Todd",
        "lastName": "Grover",
        "gender": "Male",
        "salary": 50000
    },
    {
        "firstName": "Sara",
        "lastName": "Baker",
        "gender": "Female",
        "salary": 40000
    }
];

document.write(employeesName[0].firstName); //Get the result








</script>


<?php get_footer(); ?>
