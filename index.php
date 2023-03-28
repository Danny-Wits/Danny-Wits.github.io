<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="index.css" />
</head>

<body>
  <br>
  <div class="con_head">
    <img class="logo" src="bg/Logo.png" alt="Logo">
     <h1 class="title">Local Social</h1> 

    <h2 class="title1">Education and Entertainment <br><i>Awaits!<i><br><br></h2>
  </div>
  <br>
  <hr>
  <br>
  <div class="info">
   <p>Get reference material for studies</p>
   <img  class="ref" src="bg/book.jfif" alt="">
   <br> <br>
   <p>Study harder to get higher rank in leaderboards</p>
   <img class="ref" src="bg/climb.png" alt="">
   <br><br>
   <p>Make more friends to climb higher in popularity </p>
   <img class="ref" src="bg/frref.png" alt="">
   <p>and much more</p>


  
  </div>
  <br>
  <hr>
  <div class="con_body">
<p class="log">Login and access ...</p>
    <form action="index.php" method="post">
      <label for="name">Name:</label>
      <input type="text" name="Name" id="name" placeholder="Name as on College ID card " required />
      <label for="Rollno">Exam Roll_no:</label>
      <input type="text" name="Rollno" id="Rollno" placeholder="Enter your Exam Roll No" />
      <label for="password">Password:</label>
      <input type="password" name="Password" id="password" placeholder="Password" required />
      <button>LOGIN</button>
    </form>

    <?php

    if (isset($_POST['Name']) and $_POST['Password'] != "") {
      include("database.php");
      $name = trim($_POST['Name'], " ");
      $roll = $_POST['Rollno'];
      $password = $_POST['Password'];

      $sql = "SELECT * FROM bca_1st_sem";

      $data = mysqli_query($connect, $sql);
      $flag = true;
      while ($row = mysqli_fetch_assoc($data)) {


        if ($name == $row["Name"] and $roll == $row["Roll_no"]) {

          $flag = false;
          if ($row['password'] == "") {
            $sql = "UPDATE `bca_1st_sem` SET `password` = '$password' WHERE `bca_1st_sem`.`Name` = '$name'";
            mysqli_query($connect, $sql);
            $_SESSION["Roll"] = $roll;
            header("Location: bio.php?enc=$roll");

          } else if ($password == $row['password']) {
            $_SESSION["Roll"] = $roll;
            header("Location: main.php?enc=$roll");


          } else {
            echo '<script type="text/JavaScript"> 
        alert("Incorrect Password");
        </script>';

          }
        }
      }
      if ($flag) {
        echo '<script type="text/JavaScript">alert("Name or Roll No is incorrect");</script>';
      } else if ($_POST['Password'] == "") {
        echo '<script type="text/JavaScript">alert("Please enter a password");</script>';
      }
    }

    ?>
  </div>
</body>

</html>