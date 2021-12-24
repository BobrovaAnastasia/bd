<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<?php
$num = $_GET['num'];
    $dbh = new PDO('mysql:dbname=Bobrova;host=localhost' , 'Bobrova' , 'ijSrGJwV');
    $sth = $dbh->prepare("SET NAMES UTF8");
$sth->execute();
    $sth = $dbh->prepare("SELECT provider_rates.id, provider_rates.rateTitle, provider_rates.rateText, provider_rates.ratePrice, provider_rates.rateVolume, provider_rates.rateSpeed FROM provider_rates WHERE provider_rates.id = $num");
    $sth->execute();
    $users = $sth->fetchAll();
    foreach ($users as $user) {
        $a = $user['rateTitle'];
    }
    ?>

  <a href="#"><?echo $a?></a>
  <a href="catalog.php">Тарифы</a>
  <a href="users.php">Пользователи</a>

<div style="padding-left:16px">
    <?php
 $sth = $dbh->prepare("SELECT provider_users.id, `name`, `idRate`, `timeConnect`, `active`, `debt`, `rateTitle` FROM `provider_users`
 join provider_rates on provider_rates.id = provider_users.idRate where provider_rates.id = $num
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

     ;}
     ?>