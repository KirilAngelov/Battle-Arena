<?php
echo '
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../assets/CSS/ArenaStage.css">

</head>
<body>

<div class="transbox">
    <br /><h1>Welcome to the arena!</h1><br />
    <br /><p>Let the battles begin!</p><br />
';

function autoload($className)
{
//list comma separated directory name
    $directory = array('../../','../../Repository/', '../../Service/');

//list of comma separated file format
    $fileFormat = array('%s.php', '%s.class.php');

    foreach ($directory as $current_dir)
    {
        foreach ($fileFormat as $current_format)
        {

            $path = $current_dir.sprintf($current_format, $className);
            if (file_exists($path))
            {
                include $path;
                return ;
            }
        }
    }
}
spl_autoload_register('autoload');

$coms = new HeroRepository();
$coms->defaultStatsDB();
$battle= new Battles();

echo '</div>
</body>

';







