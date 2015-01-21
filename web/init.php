 <?php
//PHP init

require_once("config.php");
require_once("pagelist.php");
require_once("github.php");

define('SITE_URL', $cfg['pageurl']);

//Class Autoloader
function class_autoloader($class) {
    include "lib/classes/" . $class . ".class.php";
}
spl_autoload_register('class_autoloader');


$url = new SimpleURL($cfg['baseurl']);
if(!empty($url->segment(1))){
    if(isset($pagelist[$url->segment(1)])){
        $page = $pagelist[$url->segment(1)];
    }else{
        $page = $pagelist['error_404'];
        header("HTTP/1.0 404 Not Found");
    }
}else{
    $page = $pagelist['dashboard'];
}

?>