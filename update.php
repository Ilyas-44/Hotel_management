<!DOCTYPE html>
<?php
require './vendor/autoload.php';
// connect to mongodb
$Conn = new MongoDB\Client("mongodb://localhost:27017");
// select a database
$db = $Conn->hotel;

//$collection = $db-> my colection;
$collection = $db->client;
  

?>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

   <title>Document</title>
</head>
<body>
   

<div class="container">
   <form method="post">
  <label for="id">Enter the id you want to update :</label><br>
  <input type="text" name="id" id="id" class="form-control"><br><br>

  <label for="nom">Enter the new name :</label><br>
  <input type="text" name="nom" id="nom" class="form-control"><br><br>

  <label for="adress">Enter the new adress :</label><br>
  <input type="text" name="adress" id="adress" class="form-control"><br><br>

  <label for="cin">Enter the new cin :</label><br>
  <input type="text" name="cin" id="cin" class="form-control"><br><br>

  <input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>
</div>

<table class="table table-striped">
  <tr>
    <th>id</th>
    <th>cin</th>
    <th>nom</th>
    <th>adress</th>
    <?php
  // select documents
  $cursor = $collection->find();
  
  echo "<h3>All documents:</h3>";
  
  foreach ($cursor as $document) {
    // start a new row
    echo "<tr>";
    // display the id and adress in table cells
    echo "<td>" . $document["id"] . "</td>";
      echo "<td>" . $document["cin"] . "</td>";
      echo "<td>" . $document["nom"] . "</td>";
      echo "<td>" . $document["adress"] . "</td>";
    // end the row
    echo "</tr>";
  }
?>
</table>

</body>
</html>