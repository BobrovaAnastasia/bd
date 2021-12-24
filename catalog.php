<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

  <a href="catalog.php">Тарифы</a>
  <a href="users.php" >Пользователи</a>




    <?php
     $dbh = new PDO('mysql:dbname=Bobrova;host=localhost' , 'Bobrova' , 'ijSrGJwV');
    $sth = $dbh->prepare("SET NAMES UTF8");
    $sth->execute();
    $search = 0;
    $sort = $_GET['sort'];
    $search = $_POST['search'];

    if(!isset($sort)){
       $sort = "ratePrice"; 
    }
    $a = $_GET['a'];
    if(!isset($a)){
       $a = " "; 
    }
    $sth = $dbh->prepare("SELECT provider_rates.id, provider_rates.rateTitle, provider_rates.rateText, provider_rates.ratePrice, provider_rates.rateVolume, provider_rates.rateSpeed
    FROM provider_rates
    $a
    ORDER BY provider_rates.$sort DESC LIMIT 5
    ");
    $sth->execute();
    $users = $sth->fetchAll();
    foreach ($users as $user) {
      $vol = $user['rateVolume'];
      if ($vol == 0) {
        $vol = "нет ограничений на использование трафика";
      }else{
        $vol = $vol . ' Гб в месяц';
      }
        echo '<h4>' . $user['rateTitle'] . ' </h4><br>Описание:' . $user['rateText'] .'<br>Максимальная скорость: '. $user['rateSpeed'] .'мб/c<br> Объем трафика:' .$vol .'<br> Цена: '. $user['ratePrice'] . ' рублей в месяц<br>'. '<a href ="str.php?num=' .$user['id']. ' ">Подключенные абоненты</a><hr>';
    }
echo "<br>";
    ?>
</body>
</html>
</body>
</html>