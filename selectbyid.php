<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<form method="post" action="" class="form-inline">
  <label for="id" class="mr-sm-2">Choose the id to show the info:</label><br>
  <select name="id" id="id" class="form-control mr-sm-2">
    <option value="">Choose id</option>

    <!-- Add options for each document in the collection -->
    <?php

require './vendor/autoload.php';
// connect to mongodb
  $Conn = new MongoDB\Client("mongodb://localhost:27017");
// select a database
  $db = $Conn->hotel;

  //$collection = $db-> my colection;
  $collection = $db->client;
  

  
      $cursor = $collection->find();
      foreach ($cursor as $document) {
        $id = htmlspecialchars($document['id']);
        echo '<option value="' . $id . '">' . $id . '</option>';
      }
    ?>
  </select><br><br>
  <button type="submit" name="show" value="Show info" class="btn btn-primary">Show info</button>
  
</form>
<?php
   // table
   echo "<table class='table table-striped' border='1'>";
   
   // table headers
   echo "<tr>";
   echo "<th>id</th>";
   echo "<th>cin</th>";
   echo "<th>nom</th>";
   echo "<th>adress</th>";
   echo "</tr>";
   if (isset($_POST['show'])) {
    // get the id and adress from the form
    $id = $_POST['id'];
   // now remove the document
   $cursor = $collection->find(array('id' => $id));
 foreach ($cursor as $document) {
      // start a new row
      echo "<tr>";
      echo "<td>" . $document["id"] . "</td>";
      echo "<td>" . $document["cin"] . "</td>";
      echo "<td>" . $document["nom"] . "</td>";
      echo "<td>" . $document["adress"] . "</td>";



      // end the row
      echo "</tr>";
   }
   
 }
   // end the table
   echo "</table>";
?>
