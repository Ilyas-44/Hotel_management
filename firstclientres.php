<!DOCTYPE html>
<html>
<head>
  <title>Reservation Table</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
   <center> 
<form method="post" class="form">
  <div class="form-group">
    <label for="">Enter id:</label> <br>
    <select name="id_client" id="id" class="form-control mr-sm-2">
    <option value="">Choose id</option>
    <?php

require './vendor/autoload.php';
  // connect to mongodb
    $Conn = new MongoDB\Client("mongodb://localhost:27017");
 // select a database
    $db = $Conn->hotel;

    //$collection = $db-> my colection;  
$collection = $db->reservation;
$cursor = $collection->find();
foreach ($cursor as $document) {
  $id = htmlspecialchars($document['id_client']);
  echo '<option value="' . $id . '">' . $id . '</option>';
} ?>
</select>
 <br> <br>
    <input type="submit" name="select" value="show" class="btn btn-primary">
</div>
</form></center>

  <div class="container">
    <h2>the first reservation :</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Client ID </th>
          <th>Earliest Reservation </th>
          <th> reservtion date </th>
          <th>id de chambre</th>
        </tr>
      </thead>
      <tbody>
        <?php

$result = [];
if (isset($_POST['select'])) {
  $id = $_POST['id_client'];
    $doc = array(
        array(
            '$match' => array('id_client' => $id)
        ),
        array(
           '$sort' => array('Date' => 1)
        ),
        array(
           '$group' => array(
              '_id' => '$id_client',
              'earliest_reservation' => array('$first' => '$date'),
              'id_res' => array('$first' => '$id_res') ,     
              'id_chambre' => array('$first' => '$id_chambre')    )
        )
     );
     $result = $collection->aggregate($doc);

    
    }



         foreach($result as $item){
            $result = $collection->aggregate($doc);
            $date_str = $item['earliest_reservation']->toDateTime()->format('Y-m-d');

          echo" <tr>";
           echo "<td>" . $item['_id'] . "</td>";
           echo "<td>" . $date_str . "</td>";
           echo "<td>" . $item["id_res"] ."</td>";
           echo "<td>" . $item["id_chambre"] ."</td>";




          echo"</tr>";
        }
         ?>
      </tbody>
    </table>
  </div>
</body>
</html>
