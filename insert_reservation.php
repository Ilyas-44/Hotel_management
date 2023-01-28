<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<html>
   <body>
   <center>  
    <h2> ajouter une nouvelle reservation : </h2>
   <form action="" method="post" class="">
         <label  class="mr-sm-2">id rservation:</label> <input type="text" name="id_res" class=" "><br>
         <label  class="mr-sm-2">duree:</label> <input type="text" name="duree" class=""><br>
         <label  class="mr-sm-2">id de chabmre:</label> <input type="text" name="id_chambre" class=""><br>
         <label  class="mr-sm-2">id de cient:</label> <input type="text" name="id_client" class=""><br>
         <label  class="mr-sm-2">date de reservation:</label> <input type="date" name="date" class=""><br>

         <input type="submit" name='post' value="insert" class="btn btn-primary">
      </form>
</center>
   </body>
</html>
<?php
    require './vendor/autoload.php';
  // connect to mongodb
    $Conn = new MongoDB\Client("mongodb://localhost:27017");
 // select a database
    $db = $Conn->hotel;

    //$collection = $db-> my colection;
    $collection = $db->reservation;
    
	
  
   if(isset($_POST['post'])){
    $date =  new MongoDB\BSON\UTCDateTime((strtotime($_POST['date']) * 1000));

$data_doc = array(
'id_res' => $_POST['id_res'],
'duree' => $_POST['duree'],
'id_chambre' => $_POST['id_chambre'],
'id_client' => $_POST['id_client'],
'date' => $date

);
$collection->insertOne($data_doc);
   echo "Database hotel inserted"; 
   
    }

    // this code below => select/find the data inserted 

   // start the table
   echo "<table class='table table-striped' border='1'>";
   
   // create the table headers
   echo "<tr>";
   echo "<th>id de reservation</th>";
   echo "<th>duree</th>";
   echo "<th>id de chambre</th>";
   echo "<th>id de client</th>";
   echo "<th>date</th>";

   echo "</tr>";
   
   $cursor = $collection->find();
   // iterate cursor to display title of documents
	
   foreach ($cursor as $document) {
    $date_str = $document["date"]->toDateTime()->format('Y-m-d');

      // start a new row
      echo "<tr>";
      // display the name in a table cell
      echo "<td>" . $document["id_res"] . "</td>";
      echo "<td>" . $document["duree"] . "</td>";
      echo "<td>" . $document["id_chambre"] . "</td>";
      echo "<td>" . $document["id_client"] . "</td>";
      echo "<td>" . $date_str. "</td>";




      // end the row
      echo "</tr>";
   }
   
   // end the table
   echo "</table>";
?>
