<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>sort chambre</title>
</head>
<body>
    <table border="1">
        <tr>
        <tr>
        <th>
            id 
            <a href="?sort=id&dir=asc"><i class='fa fa-sort-up'></a>
            <a href="?sort=id&dir=desc"><i class='fa fa-sort-down'></a>
        </th>
        <th>
            surface
            <a href="?sort=surface&dir=asc"><i class='fa fa-sort-up'></a>
            <a href="?sort=surface&dir=desc"><i class='fa fa-sort-down'></a>
        </th>
        <th>
            etage 
            <a href="?sort=etage&dir=asc"><i class='fa fa-sort-up'></a>
            <a href="?sort=etage&dir=desc"><i class='fa fa-sort-down'></a>
        </th>
        <th>
            capacite de perssone 
            <a href="?sort=capacite_de_perssone&dir=asc"><i class='fa fa-sort-up'></a>
            <a href="?sort=capacite_de_perssone&dir=desc"><i class='fa fa-sort-down'></a>
        </th>
        <th>
            price
            <a href="?sort=price&dir=asc"><i class='fa fa-sort-up'></a>
            <a href="?sort=price&dir=desc"><i class='fa fa-sort-down'></a>
        </th>
    </tr>

</body>
</html>
<?php
 require './vendor/autoload.php';

 // connect to mongodb
 $Conn = new MongoDB\Client("mongodb://localhost:27017");
 // select a database
 $db = $Conn->hotel;
$collection = $db -> chambre;
//  $pipline = [];
//  if(isset($_GET['sort']))
//  {
//     if($_GET['sort'] == 'asc')
//     {
//         $pipline = [[
//             '$sort' => ['price'=> -1 ]
//         ]];
//     }
//     elseif($_GET['sort'] == 'desc')
//     {
//         $pipline = [[
//             '$sort' => ['price'=> 1 ]
//         ]];
//     }
//  }
 $pipeline = [];
 if(isset($_GET['sort']) && isset($_GET['dir'])) {
    $sort = $_GET['sort'];
    $dir = $_GET['dir'] == 'asc' ? 1 : -1;
    $pipeline = [[
            '$sort' => [$sort => $dir ]
    ]];
 }


 $cursor=$collection->aggregate($pipeline) ;
    foreach($cursor as $document){
       echo"<tr>";
       echo "<td> ".$document['id']."<br>". "</td>"  ;
       echo "<td> ".$document['surface']."<br>". "</td>"  ;
       echo "<td> ".$document['etage']."<br>". "</td>"  ;
       echo "<td> ".$document['capacite de persone']."<br>". "</td>"  ;
       echo "<td> ".$document['price']."<br>". "</td>"  ;
       echo "</tr>";
   
    }
 
 
?>
