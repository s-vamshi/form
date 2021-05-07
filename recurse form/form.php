<?php

if(isset($_POST['submit']))
{
  $name = $_POST["name"];
  $mobile =$_POST["mobile"];
  $mail = $_POST["mail"];
  $year = $_POST["year"];
  $branch = $_POST["branch"];
  $class = $_POST["class"];
  $birthday = $_POST["birthday"];
  $birthday = str_replace("/","-",$birthday);
  $roll = $_POST["res_code"];

  $servername = "localhost";
  $username = "root";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $db = "CREATE DATABASE if not exists recurse";
  if ($conn->query($db) === TRUE) {
    $dbname = "recurse";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $table = "CREATE TABLE if not exists details(name varchar(30) not null,number varchar(30),mail varchar(30),
    year varchar(4),branch varchar(4),section varchar(1),birthday date,roll_num varchar(30),primary key(roll_num))";
    if ($conn->query($table) === TRUE) {
      $sql = "INSERT INTO details VALUES ('$name','$mobile','$mail','$year','$branch','$class',STR_TO_DATE('$birthday','%d-%m-%Y,'),'$roll')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
      }
    } else {
      echo "Error creating table: " . $conn->error;
      exit();
    }
    

  } else {
    echo "Error creating database: " . $conn->error;
    exit();
  }


  $conn->close();
}
else{
  exit("ERROR");
}
?>