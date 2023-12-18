<?php 

function InclureClasses($className)
{
    if(file_exists($fichier = __DIR__.'/'.$className.'.php'))
    {
        require $fichier;
    }
}
spl_autoload_register('InclureClasses');


?>