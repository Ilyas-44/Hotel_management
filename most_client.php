<center> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<form method="post" class="form">
  <div class="form-group">
    <h2>click to see the client that have the most reservation </h2>
    <input type="submit" name="submit" value="show" class="btn btn-primary">
</div>
</form></center><?php
require './vendor/autoload.php';
// connect to mongodb
  $Conn = new MongoDB\Client("mongodb://localhost:27017");
// select a database
  $db = $Conn->hotel;

  //$collection = $db-> my colection;
  
  
$collection = $db->reservation;

$result=[];
if (isset($_POST['submit'])) {
    $doc = [
        [
            '$group' => [
                '_id' => '$id_client',
                'id_chambre' => ['$first' => '$id_chambre'],
                'Nombre de reservation' => ['$sum' => 1],
            ],
        ],
        [
            '$sort' => [
                'count' => 1,
            ],
        ],
        [
            '$limit' => 1,
        ],
    ];
    $result = $collection->aggregate($doc);




?>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Client ID</th>
        <th>ID chambre</th>
        <th>Nombre de reservation</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $item): ?>
        <tr>
          <td><?php echo $item['_id']; ?></td>
          <td><?php echo $item['id_chambre']; ?></td>
          <td><?php echo $item['Nombre de reservation']; ?></td>
        </tr>
      
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
      <?php  } ?>