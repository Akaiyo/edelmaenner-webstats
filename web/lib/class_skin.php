<?php

class Skin {
	private $username;
	function __construct($string)
	{
		$this->username = $string;
	}
	
	private function fetchSkin()
	{
		$skin = file_get_contents("https://s3.amazonaws.com/MinecraftSkins/" . $this->username . ".png");
		return $skin;
	}
	
	public function getSkin($not_cached = false)
	{
		if($not_cached == true)
		{
			return $this->fetchSkin();
		}else{
			if(!file_exists('img/skins_cache/' . $this->username . '.png'))
			{
				$skin = $this->fetchSkin();
				file_put_contents('img/skins_cache/' . $this->username . '.png', $skin);
				return $this->fetchSkin();
			}elseif(!filemtime('img/skins_cache/' . $this->username . '.png') <= time() - 21600){
				$skin = file_get_contents('img/skins_cache/' . $this->username . '.png');
				return $skin;
			}
		}
	}
	
	public function getHeadHelm($size)
	{
		$im = imagecreatefromstring($this->getSkin(false));
		$av = imagecreatetruecolor($size, $size);
		imagecopyresized($av, $im, 0, 0, 8, 8, $size, $size, 8, 8);         // Face
		imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
		imagecopyresized($av, $im, 0, 0, 8 + 32, 8, $size, $size, 8, 8);    // Accessories
		return $av;
	}
}
