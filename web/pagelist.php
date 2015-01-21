<?php
	$pagelist = array();

	//Register Pages here
	$pagelist["dashboard"] = new Page("pages/dashboard.php","Dashboard","fa fa-home fa-fw");
	$pagelist["toplist"] = new Page("pages/toplist.php","Topliste","fa fa-bar-chart fa-fw");
	$pagelist["player"] = new Page("pages/player.php","Spieler","fa fa-dashboard fa-fw");
	$pagelist["devstats"] = new Page("pages/devstats.php","Entwicklung","fa fa-dashboard fa-fw");

	$pagelist["error_404"] = new Page("pages/error_404.php", "404 - Seite nicht gefunden", false);
	
	class Page
	{
		
		public $page;
		public $name;
		public $icon;

		public function __construct($page,$name,$icon)
		{
			$this->page = $page;
			$this->name = $name;
			$this->icon = $icon;
		}
	}
?>
