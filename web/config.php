<?php
	$cfg = array();
	
	$cfg["debug"] = true; //display warnings and errors

	//configuration for developer statistics
	$cfg["github_api_url"] = "https://api.github.com/repos/Akaiyo/edelmaenner-webstats/commits"; //api url
	$cfg["github_api_token"] = "01a4e96cefd26072fe0155460965470b6ff99fd2"; //personal access token
	$cfg["github_api_ssl_verify"] = false; //verify the connection (use private key and certificate)
	//$cfg["github_api_ssl_cert"] = ""; //path to certificate ( .pem)
	//$cfg["github_api_ssl_cert_pw"] = ""; //password for the certificate
	//$cfg["github_api_ssl_key"] = ""; //path to private key ( .pem)
	//$cfg["github_api_ssl_key_pw"] = ""; //password private key
	
	//genereal configuration for the site
	$cfg['pagetitle'] = 'Edelmänner Webstats';
?>
