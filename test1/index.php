<?php
echo '
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="Styles.css">

</head>
<body>

<div class="transbox">
    <br /><h1>Welcome to the arena!</h1><br />
    <br /><p>Let the battles begin!</p><br />
';

require_once "Battlefield.php";
include'Commands.php';
require_once 'ConnectDb.php';
require_once 'Hero.php';
/*
$coms= new Commands();

$coms->showHealth('Patrick');
echo '<br/>';
$coms->setStamina('Patrick',50);
echo '<br/>';
$coms->showStamina('Patrick');

die();*/
$start= new Battlefield();


$hero1= new Hero("Aragorn",70,60);
$hero2= new Hero("Orc",90,30);
$battlefield= new Battlefield();

if (! empty($_POST['forPeople'])) {

    $battlefield->Battle($hero1, $hero2);
}
elseif(! empty($_POST['forHorde']))
{
    $battlefield->Battle($hero2, $hero1);
}


echo '</div>
</body>

';







