<?php

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'xampp' .DS. 'htdocs'.DS. 'frontend'.DS. 'school' );
    
    // C:\xampp\htdocs\frontend\school\includes
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes' );
    // C:\xampp\htdocs\frontend\school\core
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core' );
    
    //load the config file
    require_once( INC_PATH.DS."config.php" );

    //core classes
    require_once( CORE_PATH.DS."student.php" );
    require_once( CORE_PATH.DS."login.php" );
    require_once( CORE_PATH.DS."marks.php" );
    require_once( CORE_PATH.DS."staff.php" );

?>