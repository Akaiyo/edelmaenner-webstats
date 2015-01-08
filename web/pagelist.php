<?php
	$pagelist = array();

	//Register Pages here
	$pagelist["dashboard"] = new Page("pages/dashboard.php","Dashboard","fa fa-dashboard fa-fw");
	$pagelist["toplist"] = new Page("pages/toplist.php","TopList","fa fa-dashboard fa-fw");
	$pagelist["player"] = new Page("pages/player.php","Player","fa fa-dashboard fa-fw");



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
