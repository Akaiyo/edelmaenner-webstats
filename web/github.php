<?php
		function generateCommitTimeline(){
			require("config.php");

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $cfg["github_api_url"]);
			curl_setopt($ch, CURLOPT_HTTPHEADER,array("Authorization: token " . $cfg["github_api_token"]));
			curl_setopt($ch, CURLOPT_USERAGENT, "Edelmaenner-Webstats");

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $cfg["github_api_ssl_verify"] ? 2 : 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $cfg["github_api_ssl_verify"]);

			if($cfg["github_api_ssl_verify"]){
				curl_setopt($ch,CURLOPT_SSLCERT, $cfg["github_api_ssl_cert"]);
				if(isset($cfg["github_api_ssl_cert_pw"]))
					curl_setopt($ch,CURLOPT_SSLCERTPASSWD, $cfg["github_api_ssl_cert_pw"]);

				curl_setopt($ch,CURLOPT_SSLKEY, $cfg["github_api_ssl_cert"]);
				if(isset($cfg["github_api_ssl_key"]))
					curl_setopt($ch,CURLOPT_SSLKEYPASSWD, $cfg["github_api_ssl_key_pw"]);
			}

			$response = curl_exec($ch);

			if($response == false){
				$httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
				$error = curl_error($ch);
				echo "<p>HTTP CODE: $httpcode</p>";
				echo "<p>Error: $error</p>";
			}

			curl_close($ch);

			if($response == false)
				return;

			$response = json_decode($response,true);

			$inverted = false;


			echo "<ul class='timeline'>";

			$num = count($response);

			foreach($response as $value){

					$commit = $value["commit"]["message"];
					$gitdate = $value["commit"]["committer"]["date"];
					$user = isset($value["committer"]["login"]) ? $value["committer"]["login"] : $value["author"]["login"];
					$avatar = $value["committer"]["avatar_url"];



					//If avatar is not set try gravatar
					if(!isset($avatar)){
						$hash = md5(strtolower(trim($value["committer"]["gravatar_id"])));
						$avatar = "http://www.gravatar.com/avatar/" . $hash;
					}

					$gitdate = new DateTime($gitdate);
					$now = new DateTime();

					$diff = $now->diff($gitdate);

					$datetext = "";

					if($diff->y != 0){
						$datetext = $diff->y . " years ago";
					}else if($diff->m != 0){
						$datetext = $diff->m . " monts ago";
					}else if($diff->d != 0){
						$datetext = $diff->d . " days ago";
					}else if($diff->h != 0){
						$datetext = $diff->h . " hours ago";
					}else if($diff->i != 0){
						$datetext = $diff->i . " minutes ago";
					}else if($diff->s != 0){
						$datetext = $diff->s . " seconds ago";
					}

					echo
					($inverted ? "<li class='timeline-inverted'>" : "<li>")."
						<div class='timeline-badge image'>
							<img src='$avatar' alt='$user'>
						</div>
						<div class='timeline-panel'>
							<div class='timeline-heading'>
								<h4 class='timeline-title'>Commit #$num</h4>
								<p><small class='text-muted#><i class='fa fa-clock-o'></i> $datetext by $user</small>
								</p>
							</div>
							<div class='timeline-body'>
								<p>$commit</p>
							</div>
						</div>
					</li>";

					$inverted = !$inverted;
					$num--;
			}

			echo "</ul>";
		}
?>
