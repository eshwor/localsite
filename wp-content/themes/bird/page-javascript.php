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











</script>


<?php get_footer(); ?>
