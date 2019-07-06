<?php
echo '
<!DOCTYPE html>
<html>
<head>

    <link rel = "stylesheet" href = "CSS/EmperorStage.css">

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
include_once "Scenes.php";



//put General hero in DB

$battle = new Battles();


echo '</div>
</body>

';
