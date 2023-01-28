<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<html>
   <body>
      <form action="insert.php " method="post" class="form-inline">
         <label for="id" class="mr-sm-2">id:</label> <input type="text" name="id" class="form-control mr-sm-2"><br>
         <label for="cin" class="mr-sm-2">cin:</label> <input type="text" name="cin" class="form-control mr-sm-2"><br>
         <label for="nom" class="mr-sm-2">nom:</label> <input type="text" name="nom" class="form-control mr-sm-2"><br>
         <label for="adress" class="mr-sm-2">adress:</label> <input type="text" name="adress" class="form-control mr-sm-2"><br>
         <input type="submit" name='post' value="insert" class="btn btn-primary">
      </form>
   </body>
</html>
<?php
    require './vendor/autoload.php';
  // connect to mongodb
    $Conn = new MongoDB\Client("mongodb://localhost:27017");
 // select a database
    $db = $Conn->hotel;

    //$collection = $db-> my colection;
    $collection = $db->client;
    
	
  
   if(isset($_POST['post'])){
$data_doc = array(
'id' => $_POST['id'],
'cin' => $_POST['cin'],
'nom' => $_POST['nom'],
'adress' => $_POST['adress']

);
$collection->insertOne($data_doc);
   echo "Database hotel inserted"; 
   
    }

    // this code below => select/find the data inserted 

   // start the table
   echo "<table class='table table-striped' border='1'>";
   
   // create the table headers
   echo "<tr>";
   echo "<th>id</th>";
   echo "<th>cin</th>";
   echo "<th>nom</th>";
   echo "<th>adress</th>";
   echo "</tr>";
   
   $cursor = $collection->find();
   // iterate cursor to display title of documents
	
   foreach ($cursor as $document) {
      // start a new row
      echo "<tr>";
      // display the name in a table cell
      echo "<td>" . $document["id"] . "</td>";
      echo "<td>" . $document["cin"] . "</td>";
      echo "<td>" . $document["nom"] . "</td>";
      echo "<td>" . $document["adress"] . "</td>";



      // end the row
      echo "</tr>";
   }
   
   // end the table
   echo "</table>";
?>
