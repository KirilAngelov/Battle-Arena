<?php
echo '
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="CSS/Styles.css">

</head>
<body>

<div class="transbox">
    <br /><h1>Welcome to the arena!</h1><br />
    <br /><p>Let the battles begin!</p><br />
';

require_once "Battlefield.php";
include 'Commands.php';
require_once 'ConnectDb.php';
require_once 'Hero.php';
require_once "Battles.php";


/*
$coms= new Commands();

$coms->showHealth('Patrick');
echo '<br/>';
$coms->setStamina('Patrick',50);
echo '<br/>';
$coms->showStamina('Patrick');

die();*/










echo '</div>
</body>

';







