<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<?php
 require './vendor/autoload.php';
 // connect to mongodb
   $Conn = new MongoDB\Client("mongodb://localhost:27017");
// select a database
   $db = $Conn->hotel;

   //$collection = $db-> my colection;
   $collection = $db->client;
   
   // table
   echo "<table class='table table-striped' border='1'>";
   
   // table headers
   echo "<tr>";
   echo "<th class='text-center'>id</th>";
   echo "<th class='text-center'>cin</th>";
   echo "<th class='text-center'>nom</th>";
   echo "<th class='text-center'>adress</th>";
   echo "</tr>";
   
   $cursor = $collection->find();
   
   foreach ($cursor as $document) {
      // start a new row
      echo "<tr class='bg-primary'>";
      
      echo "<td class='text-center'>" . $document["id"] . "</td>";
      echo "<td class='text-center'>" . $document["cin"] . "</td>";
      echo "<td class='text-center'>" . $document["nom"] . "</td>";
      echo "<td class='text-center'>" . $document["adress"] . "</td>";



      // end the row
      echo "</tr>";
   }
   
   // end the table
   echo "</table>";
?>
