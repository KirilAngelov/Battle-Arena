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
/*include 'ConnectDb.php';

$str = "SELECT * FROM heroes";
try{
    $connection = ConnectDb::getInstance()->getConnection();
    $stm = $connection->prepare($str);
    $stm->execute();
    var_dump($stm->fetch(PDO::FETCH_ASSOC));

}
catch (PDOException $exception)
{
    echo "Connection failed".$exception->getMessage();
}
*/

include "Battlefield.php";
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







