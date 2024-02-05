<?php
echo "Welcome to the stage where we are ready to get connected to a database<br>";
/* Ways to connect to a MySQL Database
1. MySQLi extension
2. PDO
*/
// Connecting to the Database
$servername = 'localhost';
$username = 'root';
$password = '';

// Create a connection
$conn = mysqli_connect($servername, $username, $password);

if(!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else {
    echo "Connection was successful<br>";
}

/*
// Creating a Database in MySQL using PHP
$createdb = "CREATE DATABASE shubhamdb";
$result = mysqli_query($conn, $createdb);

// Check for the database creation success
if($result){
    echo "Database creation successful";
}
else{
    echo "Unsuccessful<br>";
    echo mysqli_error($conn);
}
*/

/*
// Creating a Table in MySQL using PHP
$createtbl = "CREATE TABLE `shubham`.`phptrip` (
    `sno` INT(6) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(11),
    `age` INT(3),
    `gender` VARCHAR(11),
    PRIMARY KEY (`sno`)
)";

$result = mysqli_query($conn, $createtbl);

if($result){
    echo "Table created successfully<br>";
}
else {
    echo "Table not created<br>";
    echo mysqli_error($conn);
}

echo "<br>";
// query to remove a table named 'phptrip' from the database 'shubham'
$removetbl = "DROP TABLE `shubham`.`phptrip`";
// mysqli_query($conn, $removetbl);

// insert records in a table 
$insert = "INSERT INTO `shubham`.`phptrip` (`sno`, `name`, `age`, `gender`) VALUES ('1', 'Shubham', '18', 'M')";
$result = mysqli_query($conn, $insert);
if($result){
    echo "Record inserted successfully<br>";
}
else{
    echo "Record cannot be created<br>";
    echo mysqli_error($conn);
}
*/

//selecting data in PHP 
$database = 'shubham';
$connShubham = mysqli_connect($servername, $username, $password, $database);
if(!$connShubham){
    echo "Sorry we failed to connect to the database shubham<br>";
}
else{
    echo "Connection shubham was successful<br>";
}

$sql = "SELECT * FROM `users`";
$result = mysqli_query($connShubham, $sql);
//find the number of records returned
$num = mysqli_num_rows($result);
echo $num." records found in the database<br>";

//Display the rows returned by the sql query
$no=1;
if($num>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $no.". ".$row['email']."   ".$row['password']."<br>";
        $no+=1;
    }
    echo "<br>The end<br>";
}

// WHERE keyword

$sql = "SELECT * FROM `users` WHERE `email`='shubhamamlani100@gmail.com'";
$result = mysqli_query($connShubham, $sql);
$num = mysqli_num_rows($result);
$no = 1;
if($num>0){
    while($row = mysqli_fetch_assoc($result)){
        echo $no.". ".$row['email']." ".$row['password']."<br>";
        $no+=1;
    }
}

// Updating data using UPDATE Clause
$sql = "UPDATE `users` SET `email`='shubhamamlani109@gmail.com' WHERE `email`='shubhamamlani100@gmail.com'";
$result = mysqli_query($connShubham, $sql);
$aff = mysqli_affected_rows($connShubham);
if($result){
    echo $aff." Rows updated successfully<br>";
}
else{
    echo "Updation unsuccessful<br>";
    echo mysqli_error($connShubham)."<br>";
}

// Deleting MySQL records with PHP
$sql = "DELETE FROM `users` WHERE `email`='shreenathjicreations104@gmail.com' LIMIT 1";
$result = mysqli_query($connShubham, $sql);
$aff = mysqli_affected_rows($connShubham);
if($result){
    echo $aff." Records deleted successfully<br>";
}
else{
    echo "Deletion unsuccessful<br>";
    echo mysqli_error($connShubham);
}
?>