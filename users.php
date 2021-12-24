<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

  <a  href="catalog.php">Тарифы</a>
  <a href="users.php" >Пользователи</a>
  
  <a href="users.php?a=1">Абоненты просрочившие абонентскую плату</a>
  <a href="users.php?a=2">100 самых долгосрочных абонентов</a><br>



 <?php
 $dbh = new PDO('mysql:dbname=Bobrova;host=localhost' , 'Bobrova' , 'ijSrGJwV');
$sth = $dbh->prepare("SET NAMES UTF8");
$sth->execute();
     $sort = $_GET['a'];
     if(!isset($sort)){
      $sth = $dbh->prepare("SELECT provider_users.id, `name`, `idRate`, `timeConnect`, `active`, `debt`, `rateTitle` FROM `provider_users`
      join provider_rates on provider_rates.id = provider_users.idRate;
      ");
      $sth->execute();
      $users = $sth->fetchAll();
      foreach ($users as $user) {
      $a = $user['debt'];
      $b = $user['id'];
      if($a>0){
        $sth = $dbh->prepare("UPDATE `provider_users` SET `active`='0' WHERE provider_users.id = $b");
        $sth->execute();
      }
      $c = $user['active'];
      if ($c == 1) {
        $c = 'Активен';
      } else {
        $c = 'Не активен';
      }
          echo 'Имя пользователя: '.$user['name'].'<br>Тариф пользователя: '. $user['rateTitle'].'<br>Дата подключения тарифа: '. $user['timeConnect'].'<br> Долг пользователя: '. $user['debt'] . '<br> ID пользователя: ' . $user['id'] .'<br> Активен или нет:' . $c. '<br>';
          echo '<a href="del.php?id='.$user['id'].'">Удалить</a>' . '<br><hr>';
          ;}
   }
   if($sort == 1){
    $sth = $dbh->prepare("SELECT provider_users.id, `name`, `idRate`, `timeConnect`, `active`, `debt`, `rateTitle` FROM `provider_users`
    join provider_rates on provider_rates.id = provider_users.idRate where provider_users.active = 0
    ");
    $sth->execute();
    $users = $sth->fetchAll();
    foreach ($users as $user) {
    $a = $user['debt'];
    $b = $user['id'];
    if($a>0){
      $sth = $dbh->prepare("UPDATE `provider_users` SET `active`='0' WHERE provider_users.id = $b");
      $sth->execute();
    }
    $c = $user['active'];
    if ($c == 1) {
      $c = 'Активен';
    } else {
      $c = 'Не активен';
    }
        echo 'Имя пользователя: '.$user['name'].'<br>Тариф пользователя: '. $user['rateTitle'].'<br>Дата подключения тарифа: '. $user['timeConnect'].'<br> Долг пользователя: '. $user['debt'] . '<br> ID пользователя: ' . $user['id'] .'<br> Активен или нет:' . $c. '<br><hr>';
        }
 }

 if($sort == 2){
  $sth = $dbh->prepare("SELECT provider_users.id, `name`, `idRate`, `timeConnect`, `active`, `debt`, `rateTitle` FROM `provider_users`
  join provider_rates on provider_rates.id = provider_users.idRate order by `timeConnect` desc LIMIT 100
  ");
  $sth->execute();
  $users = $sth->fetchAll();
  foreach ($users as $user) {
  $a = $user['debt'];
  $b = $user['id'];
  if($a>0){
    $sth = $dbh->prepare("UPDATE `provider_users` SET `active`='0' WHERE provider_users.id = $b");
    $sth->execute();
  }
  $c = $user['active'];
  if ($c == 1) {
    $c = 'Активен';
  } else {
    $c = 'Не активен';
  }
      echo 'Имя пользователя: '.$user['name'].'<br>Тариф пользователя: '. $user['rateTitle'].'<br>Дата подключения тарифа: '. $user['timeConnect'].'<br> Долг пользователя: '. $user['debt'] . '<br> ID пользователя: ' . $user['id'] .'<br> Активен или нет:' . $c. '<br><hr>';
      }
 }


    ?></div>
</body>
</html>



