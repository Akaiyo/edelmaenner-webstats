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

	//general configuration for the site
	$cfg['pagetitle'] = 'Edelmänner Webstats';#

	//time in seconds for the cached skins before they get retrieved again from minecraft.net
	//$cfg['skins_cache_time'] = 21600; // WIRD NOCH NICHT VERWENDET

	//Include specific sql config
	include("sql_config.php");

	//Material names
	$cfg["text"]["material"] = array (
		0 => 'Luft',
		1 => 'Stein',
		2 => 'Gras',
		3 => 'Erde',
		4 => 'Pflasterstein',
		5 => 'Holz',
		6 => 'Setzling',
		7 => 'Bedrock',
		8 => 'Wasser',
		9 => 'Stehendes Wasser',
		10 => 'Lava',
		11 => 'Stehende Lava',
		12 => 'Sand',
		13 => 'Kies',
		14 => 'Golderz',
		15 => 'Eisenerz',
		16 => 'Kohle',
		17 => 'Baumstamm',
		18 => 'Blätter',
		19 => 'Schwamm',
		20 => 'Glas',
		21 => 'Lapis Lazuli (Erz)',
		22 => 'Lapis Lazuli (Block)',
		23 => 'Dispenser',
		24 => 'Sandstein',
		25 => 'Notenblock',
		26 => 'Bett',
		27 => 'Booster-Schiene',
		28 => 'Detektor-Schiene',
		29 => 'Haftender Kolben',
		30 => 'Spinnennetz',
		31 => 'Hohes Gras',
		32 => 'Toter Strauch',
		33 => 'Kolben',
		34 => 'Kolben-Erweiterung',
		35 => 'Wolle',
		36 => 'Kolben bewegter Block',
		37 => 'Gelbe Blume',
		38 => 'Rose',
		39 => 'Brauner Pilz',
		40 => 'Fliegenpilz',
		41 => 'Goldblock',
		42 => 'Eisenblock',
		43 => 'Doppelte Stufe',
		44 => 'Stufe',
		45 => 'Ziegelstein',
		46 => 'TNT',
		47 => 'Bücherregal',
		48 => 'Bemooster Pflasterstein',
		49 => 'Obsidian',
		50 => 'Fackel',
		51 => 'Feuer',
		52 => 'Mob-Spawner',
		53 => 'Holztreppe',
		54 => 'Truhe',
		55 => 'Redstonekabel',
		56 => 'Diamanterz',
		57 => 'Diamantblock',
		58 => 'Werkbank',
		59 => 'Getreide',
		60 => 'Ackerboden',
		61 => 'Ofen',
		62 => 'Brennender Ofen',
		63 => 'Schild',
		64 => 'Holztür',
		65 => 'Leiter',
		66 => 'Schienen',
		67 => 'Steintreppe',
		68 => 'Wandschild',
		69 => 'Hebel',
		70 => 'Steinerne Druckplatte',
		71 => 'Eisentür',
		72 => 'Hölzerne Druckplatte',
		73 => 'Redstoneerz',
		74 => 'Leuchtendes Redstoneerz',
		75 => 'Redstone-Fackel (aus)',
		76 => 'Redstone-Fackel (an)',
		77 => 'Steinschalter',
		78 => 'Schnee',
		79 => 'Eis',
		80 => 'Schneeblock',
		81 => 'Kaktus',
		82 => 'Lehm',
		83 => 'Zuckerrohr',
		84 => 'Jukebox',
		85 => 'Zaun',
		86 => 'Kürbis',
		87 => 'Netherrack',
		88 => 'Soul Sand',
		89 => 'Glowstone',
		90 => 'Portal',
		91 => 'Jack-O-Lantern',
		92 => 'Kuchenblock',
		93 => 'Redstone Repeater (aus)',
		94 => 'Redstone Repeater (an)',
		95 => 'verschlossene Truhe',
		96 => 'Falltür',
		97 => 'Stein mit Silberfisch',
		98 => 'Steinziegel',
		99 => 'Roter Pilzblock',
		100 => 'Brauner Pilzblock',
		101 => 'Eisengitter',
		102 => 'Glasscheibe',
		103 => 'Melone',
		104 => 'Kürbiskerne',
		105 => 'Melonenkerne',
		106 => 'Liane',
		107 => 'Zauntor',
		108 => 'Ziegeltreppe',
		109 => 'Steinziegeltreppe',
		110 => 'Myzel',
		111 => 'Seerose',
		112 => 'Netherziegel',
		113 => 'Netherziegelzaun',
		114 => 'Netherziegeltreppe',
		115 => 'Netherwarze',
		116 => 'Zaubertisch',
		117 => 'Braustand',
		118 => 'Kessel',
		119 => 'Enderportal',
		120 => 'Enderportal-Block',
		121 => 'Endstein',
		122 => 'Drachenei',
		123 => 'Redstone-Lampe (aus)',
		124 => 'Redstone-Lampe (an)',
		125 => 'Doppelte Holzstufe',
		126 => 'Holzstufe',
		127 => 'Kakaopflanze',
		128 => 'Sandsteintreppe',
		129 => 'Smaragderz',
		130 => 'Endertruhe',
		131 => 'Haken',
		132 => 'Stolperdraht',
		133 => 'Smaragdblock',
		134 => 'Fichtenholztreppe ',
		135 => 'Birkenholztreppe',
		136 => 'Tropenholztreppe',
		137 => 'Kommandoblock',
		138 => 'Leuchtfeuer',
		139 => 'Pflastersteinmauer',
		140 => 'Blumentopf',
		141 => 'Karotte',
		142 => 'Kartoffel',
		143 => 'Knopf',
		144 => 'Schedel',
		145 => 'Amboss',
		146 => 'Redstonetruhe',
		147 => 'Gewichtete Druckplatte (leicht)',
		148 => 'Gewichtete Druckplatte (schwer)',
		149 => 'Comparator Off',
		150 => 'Comparator On',
		151 => 'Tageslichtsensor',
		152 => 'Redstoneblock',
		153 => 'Netherquarzerz',
		154 => 'Trichter',
		155 => 'Quarzblock',
		156 => 'Quarztreppe',
		157 => 'Aktivierungsschiene',
		158 => 'Spender',
		159 => 'Gefärbter Lehm',
		160 => 'Gefärbte  Glasscheibe',
		161 => 'Laub',
		162 => 'Holz',
		163 => 'Akazienholztreppe',
		164 => 'Schwarzeichenholztreppe',
		165 => 'Schleimblock',
		166 => 'Barriere',
		167 => 'Eisenfalltür',
		168 => 'Prismarin',
		169 => 'Seelaterne',
		170 => 'Strohballen',
		171 => 'Teppich',
		172 => 'Gebrannter Lehm',
		173 => 'Kohleblock',
		174 => 'Packeis',
		175 => 'Große Blumen',
		176 => 'Banner',
		177 => 'Wandbanner',
		178 => 'Nachtlichtsensor',
		179 => 'Roter Sandstein',
		180 => 'Rote Sandsteintreppe',
		181 => 'Doppelte Steinstufe',
		182 => 'Steinstufe',
		183 => 'Fichtenholzzauntor',
		184 => 'Birkenholzzauntor',
		185 => 'Tropenholzzauntor',
		186 => 'Schwarzeichenholzzauntor',
		187 => 'Akazienholzzauntor',
		188 => 'Fichtenholzzaun',
		189 => 'Birkenholzzaun',
		190 => 'Tropenholzzaun',
		191 => 'Schwarzeichenholzzaun',
		192 => 'Akazienholzzaun',
		193 => 'Fichtenholztür',
		194 => 'Birkenholztür',
		195 => 'Tropenholztür',
		196 => 'Akazienholztür',
		197 => 'Schwarzeichenholztür'
	);
?>
