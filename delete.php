<?php
  require './vendor/autoload.php';
  // connect to mongodb
  $Conn = new MongoDB\Client("mongodb://localhost:27017");
  // select a database
  $db = $Conn->hotel;
 
  //$collection = $db-> my colection;
  $collection = $db->client;
     
    
   
  if (isset($_POST['submit'])) {
    // get the id and adress from the form
    $id = $_POST['id'];
    
    

    // now remove the document
    $collection->deleteOne(array("id" => "$id"));
    echo "Document deleted successfully";
  }
?>

<!-- add Bootstrap styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- add a container to center the form and table -->
<div class="container mt-5">
  <!-- create the form using Bootstrap styles -->
  <form method="post" class="form-inline">
    <label for="id" class="mr-2">Enter the id you want to delete:</label>
    <input type="text" name="id" id="id" class="form-control mr-2">
    <input type="submit" name="submit" value="Delete" class="btn btn-primary">
  </form>

  <!-- display the available documents in a table using Bootstrap styles -->
  <h3 class="mt-5">All documents:</h3>
  <table class="table table-striped">
    <tr>
      <th>id</th>
      <th>cin</th>
      <th>nom</th>
      <th>adress</th>
    </tr>
    <?php
      // select documents
      $cursor = $collection->find();

      foreach ($cursor as $document) {
        // start a new row
        echo "<tr> ";
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
</div>
