<?php 

/*
Variables in PHP

echo "This is Variables in PHP"
$name = "Shubham";
$namE = "Harry";
$income = 200.54;
echo "This guy is $namE and his income is INR $income<br>";
echo "$name is a Hackerman<br>";
*/

/* 
More on Variables
Rules for declaring variables


$lineNo4 = "this line";
echo $lineNo4;
*/

/*
Data types in PHP
1. String
2. Integer
3. Float
4. Boolean
5. Object
6. Array
7. NULL

//String - sequence of characters
$name = "Shubham";
$friend = "Harry";
echo "$name ka friend is $friend <br>";

// Integer - non-decimal number
$income = 2000;
$debts = -455;
echo "$income <br> $debts <br>";

// Float - Decimal point number
$income = 200.54;
$debts = -644.23;
echo "$income <br> $debts <br>";

// Boolean - true or false
$x=true;
$is_friend=false;
echo var_dump($x);
echo "<br>";
var_dump($is_friend);

// Object - Instances of classes

// Array - Used to store multiple values in a single variable
$friends = array("rohan", "shubham", "skillf", "Larry");
echo "<br>";
echo var_dump($friends);
echo "<br>";
echo $friends[0];
echo "<br>";
echo $friends[1];
echo "<br>";
echo $friends[2];
echo "<br>";
echo $friends[3];

// NULL
$name = NULL;
echo "<br>";
echo var_dump($name);
*/

/*
String and String Functions


$name= "Shubham";
echo $name;
echo "<br>";
// Dot (.) operator is used to concatenate two strings
echo "The lenght of my string is ".strlen($name);
echo "<br>";
$sentence = "Shubham is a good boy!";
echo str_word_count($sentence);
echo "<br>";
echo strrev($name);
echo "<br>";
echo strpos($sentence, "Shu");
echo "<br>";
echo str_replace("Shubham", "Harry", $sentence);
echo "<br>";
echo str_repeat("$name<br>", 12);
echo "<br>";
echo "<pre>";
echo rtrim("     this is a string       ");
echo ltrim("     this is a string       ");
echo "</pre>";
echo "<br>";
*/

/* Operators in PHP 
1. Arithmetic
2. Assignment
3. Comparison   (Not equal to operator: <>)
4. Logical      (they can be written as 'and' and 'or' or as '&&', '||' and '!')
*/

/* 
if-else conditionals


$a = 790;
$b = 9;

if($a > 78){
    // echo "a is greater than 78";
}
else {
    // echo "a is not greater than 78";
}

$age = 45;
if ($age>18){
    echo "You can drink alcohol<br>";
}
if($age>13){
    echo "You can drink softdrinks. No alcohol for you<br>";
}
else{
    echo "You may drink water";
}

if($age>=25 && $age<=65) {
    echo "<br>You're hired for the driver's job";
}
*/

/*
switch case in PHP


$age = 56;

switch($age){
    case 12:
        echo "You're 12 years old";
        break;

    case 45:
        echo "You're 45 years old";
        break;

    case 56:
        echo "You're a 56 year old boy";
        break;

    default:
        echo "Your age is weird";
    }
*/

/*
Loops in PHP

// Basic loops
$num=0;
while($num<5){
    echo "While ".($num+1)."<br>";
    $num++;
}
echo "while loop has ended";
echo "<br>";
echo "<br>";

do{
    echo "Do while ".($num+1)."<br>";
    $num++;
}while($num<10);
echo "do-while loop has ended";
echo "<br>";
echo "<br>";

for($num=0;$num<10;$num++){
    echo "Num For ". ($num+1). "<br>";
}
echo "For loop has ended";


// foreach loop
$arr = array("Bananas", "Apples", "Harpic", "Bread", "Butter", "Cheese");
foreach($arr as $value) {
    echo "$value <br>";
}
*/

/*
functions in PHP


function processMarks($marksArr){
    $sum = 0;
    foreach ($marksArr as $value) {
        $sum += $value;
    }
    return $sum;
}

function avgMarks($marksArr){
    $sum = 0;
    $i=1;
    foreach ($marksArr as $value) {
        $sum += $value;
        $i++;
    }
    return $sum/$i;
}


$rohanDas = [34, 98, 45, 12, 98, 93];
$sumMarks = processMarks($rohanDas);
$avgMarks = avgMarks($rohanDas);
echo "Total marks scored by Rohan Das : $sumMarks";
echo "<br>";
echo "Average marks scored by Rohan Das : $avgMarks";
echo "<br>";
$shubham = [99, 98, 93, 94, 0, 82];
$sumMarks = processMarks($shubham);
$avgMarks = avgMarks($shubham);
echo "Total marks scored by Shubham : $sumMarks";
echo "<br>";
echo "Average marks scored by Shubham : $avgMarks";
*/

/*
Date function in PHP


$d = date("dS M Y l, g:i A");
echo "Today's date is $d";
$year = date("Y");
echo "<br>Copyright $year | All rights reserved";
*/

/*
Associative arrays

$favCol = array(
    'Shubham' => 'red',
    'Rohan' => 'green',
    'Harry' => 'brown',
    8 => 'this'
);

foreach($favCol as $key => $value){
    echo "Favourite color of $key is $value <br>";
}
// echo $favCol['Shubham'];
// echo "<br>";
// echo $favCol['Rohan'];
// echo "<br>";
// echo $favCol['Harry'];
// echo "<br>";
// echo $favCol[8];
*/

/*
Multi-dimensional arrays in PHP

$multiDim = array(
    array(2, 5, 7, 8),
    array(1, 2, 3, 1),
    array(4, 5, 0, 1)
);
// echo var_dump($multiDim);
// Printing contents of 2D array
foreach($multiDim as $arr){
    foreach($arr as $value){
        echo $value . " ";
    }
    echo "<br>";
}
*/

/*
Scope, Local and Global in PHP

$a = 98;
$b = 9;
function printValue(){
    // $a = 97;
    global $a, $b;
    $a = 100;
    $b = 1000; // This will change the global variable
    echo "The value of your variable a is $a and b is $b";
}
printValue();
echo "<br>";
echo $a;
echo "<br>";
echo $b;
echo "<br>";
// echo var_dump($GLOBALS); // Prints all global variables
echo var_dump($GLOBALS['a']);
echo var_dump($GLOBALS['b']);
*/
?>