<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>sort by</title>
</head>
<body>
  
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

  echo "<center>";
  echo "<h4> HERE WE HAVE ALL RESERVATION :</h4>";
  echo "<table class='table table-striped' border='1'>";

  // table headers
  echo "<tr>";
  echo "<th class='text-center'>id_res</th>";
  echo "<th class='text-center'>duree</th>";
  echo "<th class='text-center'>id_chambre</th>";
  echo "<th class='text-center'>id_client</th>";
  echo "<th class='text-center'>
        date
 
    <a href='?sort=asc'><i class='fa-solid fa-sort-up'></i></a>
    <a href='?sort=desc'><i class='fa-solid fa-sort-down'></i></a></th>";
  echo "</tr>";
  if(isset($_GET['sort']) && $_GET['sort'] == 'asc'){
    $cursor = $collection->aggregate([
      [      '$sort' => [ 'date' => 1 ]
    ]
    ]);
    foreach ($cursor as $document) {
      // start a new row
      echo "<tr class='bg-primary'>";
  
      echo "<td class='text-center'>" . $document["id_res"] . "</td>";
      echo "<td class='text-center'>" . $document["duree"] . "</td>";
      echo "<td class='text-center'>" . $document["id_chambre"] . "</td>";
      echo "<td class='text-center'>" . $document["id_client"] . "</td>";
      echo "<td class='text-center'>" . $document["date"]->toDateTime()->format('Y-m-d') . "</td>";
  
      // end the row
      echo "</tr>";
    }
  // foreach($cursor as $total){
  //   echo "id_res : $total->id_res " ;
  //   echo "duree : $total->duree "  ;
  //   echo "id_chambre : $total->id_chambre" ;
  // };
}
elseif(isset($_GET['sort']) && $_GET['sort'] == 'desc' ){
  $cursor = $collection->aggregate([
    [      '$sort' => [ 'date' => -1 ]
  ]
]);
  foreach ($cursor as $document) {
    // start a new row
    echo "<tr class='bg-primary'>";

    echo "<td class='text-center'>" . $document["id_res"] . "</td>";
    echo "<td class='text-center'>" . $document["duree"] . "</td>";
    echo "<td class='text-center'>" . $document["id_chambre"] . "</td>";
    echo "<td class='text-center'>" . $document["id_client"] . "</td>";
    echo "<td class='text-center'>" . $document["date"]->toDateTime()->format('Y-m-d') . "</td>";

    // end the row
    echo "</tr>";
  }
  } else {
    $cursor = $collection->find();
      foreach ($cursor as $document) {
        // start a new row
        echo "<tr class='bg-primary'>";

        echo "<td class='text-center'>" . $document["id_res"] . "</td>";
        echo "<td class='text-center'>" . $document["duree"] . "</td>";
        echo "<td class='text-center'>" . $document["id_chambre"] . "</td>";
        echo "<td class='text-center'>" . $document["id_client"] . "</td>";
        echo "<td class='text-center'>" . $document["date"]->toDateTime()->format('Y-m-d') . "</td>";

        // end the row
        echo "</tr>";
      }
  }

  // foreach($cursor as $total){
  //   echo "id_res : $total->id_res " ;
  //   echo "duree : $total->duree "  ;
  //   echo "id_chambre : $total->id_chambre" ;
  // };
  // }

      

  // end the table
  echo "</table>";
  echo"</center>";
?>
