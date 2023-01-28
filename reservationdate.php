<html>
   <body>
      <form  method="post">
         <h2> showing reservation between this 2 dates :</h2>
         first date : <input type="date" name="start_date"><br>
         second date : <input type="date" name="end_date"><br>

         <input type="submit" name='show' value="show">
      </form>
   </body>
</html>

<?php
require './vendor/autoload.php';

// Connect to MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database
$db = $client->hotel;

// Select the collection
$collection = $db->reservation;

if (isset($_POST['show'])) {
    // Get the start and end dates from the input fields

    $start_date =  new MongoDB\BSON\UTCDateTime((strtotime($_POST['start_date']) * 1000));
    $end_date =  new MongoDB\BSON\UTCDateTime((strtotime($_POST['end_date']) * 1000));



    // Construct the query document
    $query = [
        'date' => [
            '$gte' => $start_date,
            '$lt' => $end_date,
        ],
    ];

    // Execute the query and get the cursor
    $cursor = $collection->find($query);

    
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th> id reservation </th>";
    echo "<th>Date</th>";
    echo "<th>duree</th>";
    echo "<th>id chambre</th>";
    echo "<th>id client</th>";


    echo "</tr>";
    
    foreach ($cursor as $document) {
      $date_str = $document["date"]->toDateTime()->format('Y-m-d');
      echo"<tr>";
      echo "<td>" . $document["id_res"] ."</td>";
      echo "<td>" . $date_str . "</td>";
      echo "<td>" . $document["duree"] ."</td>";
      echo "<td>" . $document["id_chambre"] ."</td>";
      echo "<td>" . $document["id_client"] ."</td>";


      echo"</tr>";

    }
    
    echo "</table>";
    
}
?>
