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

<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Akaiyo, minifisch">

    <title>
        <?php
            echo( $cfg['pagetitle'] . ' | ' . $pagelist[$reqpage]->name );
        ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--MetisMenu CSS-->
    <link href="plugins/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!--Timeline CSS-->
    <link href="css/timeline.css" rel="stylesheet">

    <!--Morris Charts CSS-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery -->
    <!-- Move jQuery to the top, but use Javascript when the document is ready -->
    <script src="plugins/jquery/dist/jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">


            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Edelmänner Webstats</a>
            </div>
            <!-- /.navbar-header -->


            <!-- Navigation begin -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!--Player search-->
                                <script type="text/JavaScript">
                                    //Register Listeners when Page is ready
                                    $( document ).ready(function( $ ) {
                                        $("#player_search_input").keyup(function(event){
                                            if(event.keyCode == 13){
                                                $("#player_search_button").click();
                                            }
                                        });

                                        $("#player_search_button").click(function(){
                                            var player = $('#player_search_input').val();
                                            if(player == "")
                                                return;
                                            window.location.href = "?page=player&name=" + player;

                                        });
                                    });
                                </script>

                                <input type="text" class="form-control" id="player_search_input" placeholder="Spieler suchen...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id = "player_search_button">
                                    <i class="fa fa-search"></i>
                                </button>
                                <!-- Player search end -->
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>


                        <!-- Navbar pages-->
                        <?php
                            foreach ($pagelist as $key => $value)
                                echo "<li><a href='?page=$key'><i class='$value->icon'></i>$value->name</a></li>";
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">


            <!-- actual page content-->
            <?php

                if(isset($pagelist[$reqpage]))
                    include($pagelist[$reqpage]->page);
            ?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="plugins/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="plugins/raphael/raphael-min.js"></script>
    <script src="plugins/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>

    <script src="js/sb-admin-2.js"></script>

</body>

</html>
