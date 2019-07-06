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
require_once 'Commands.php';
require_once 'ConnectDb.php';
require_once 'Hero.php';
require_once "Battles.php";



$coms= new Commands();
$result=$coms->getById(2);
print_r($result);
$coms->defaultStats();
$coms->showHealth("Orc");
$coms->showStamina("Orc");
$coms->showXp("Orc");

die();










echo '</div>
</body>

';







