
<html>
   <body>
      <form  method="post">
         id: <input type="text" name="id"><br>
         cin: <input type="text" name="cin"><br>
         nom: <input type="text" name="nom"><br>
         adress: <input type="text" name="adress"><br>

         <input type="submit" name='post' value="insert">

         <input type="submit" name="delete" value="Deleete">

         <input type="submit" name="update" value="Update">

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
    if (isset($_POST['delete'])) {
        // get the id and adress from the form
        $id = $_POST['id'];
        
        
    
       // now remove the document
       $collection->deleteOne(array("id" => "$id"));
       echo "Document deleted successfully";
     }
     if (isset($_POST['update'])) {
        // get the id and adress from the form
        $id = $_POST['id'];
        $adress = $_POST['adress'];
        $nom = $_POST['nom'];
        $cin = $_POST['cin'];
        
        // update the documents with the new id and adress
        $collection->updateMany(array("id"=>$id), 
           array('$set'=>array("id"=>$id, "adress"=>$adress, "nom"=>$nom, "cin"=>$cin)));
        echo "Document updated successfully";
     }
    


    

    // this code below => select/find the data inserted 

   // start the table
   echo "<table border='1'>";
   
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