 <?php
        //PHP init
        define('ROOT_DIR', __DIR__);

        require_once("config.php");
        require_once("pagelist.php");
        require_once("github.php");

        //Class Autoloader
        function class_autoloader($class) {
            include "lib/classes/" . $class . ".class.php";
        }

        spl_autoload_register('class_autoloader');

		$reqpage = isset($_GET["page"]) ? $_GET["page"] : "dashboard";
		if(isset($_GET['page']) && ctype_alnum($_GET['page']))
		{
			if(file_exists("pages/" . $reqpage . ".php"))
			{
				$reqpage = $_GET['page'];
			}else{
				$reqpage = 'dashboard';
			}
		}else{
			$reqpage = 'dashboard';
		}
?>