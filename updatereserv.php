<?php
 require './vendor/autoload.php';
 // connect to mongodb
   $Conn = new MongoDB\Client("mongodb://localhost:27017");
// select a database
   $db = $Conn->hotel;

   //$collection = $db-> my colection;
   $collection = $db->reservation;
     
   // check if the form has been submitted
   if (isset($_POST['update'])) {
    // get the id and adress from the form
    $id = $_POST['id_res'];

    $date =  new MongoDB\BSON\UTCDateTime((strtotime($_POST['date']) * 1000));
    
    
    // update the documents with the new id and adress
    $collection->updateMany(array("id_res"=>$id), 
       array('$set'=>array("id_res"=>$id, "date"=>$date)));
    echo "Document updated successfully";
 }

 
?>

<form method="post">
  <label for="id">Enter the id_res you want to update :</label><br>
  <input type="text" name="id_res" id="id"><br><br>

  <label for="nom">Enter the new date :</label><br>
  <input type="date" name="date" id="date"><br><br>

  <input type="submit" name="update" value="Update">
</form>


<!-- this code below is just to show the data updated -->
<?php
 // open table
 echo "<table border='1'>";
 
 // table headers
 echo "<tr>";
 echo "<th>id_res</th>";
 echo "<th>date</th>";
 
 echo "</tr>";
 
 // select documents
 $cursor = $collection->find();
  
 
 echo "<h3>all documents :</h3>";
  
 foreach ($cursor as $document) {
    // $date_str = $document["date"]->toDateTime()->format('Y-m-d');

    // start a new row
    echo "<tr>";
    // display the id and adress in table cells
    echo "<td>" . $document["id_res"] . "</td>";
      echo "<td>" . $document["date"]. "</td>";
     

    // end the row
    echo "</tr>";
 }
 
 // end the table
 echo "</table>";
 ?>
