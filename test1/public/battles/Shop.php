<?php


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

if (isset($_GET['armor'])) {

    $coms= new HeroRepository();
    $coms->setHealthDB("Aeneas",$coms->showHealth("Aeneas")+35);
    $coms->setHealthDB("Orc",$coms->showHealth("Orc")+35);
}
elseif (isset($_GET['horse'])) {

    $coms= new HeroRepository();
    $coms->setStaminaDB("Aeneas",$coms->showStamina("Aeneas")+20);
    $coms->setStaminaDB("Orc",$coms->showStamina("Orc")+20);
}

header('Location: ../templates/FinalBattle.html');







