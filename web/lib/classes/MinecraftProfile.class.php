<?php
	class MinecraftProfile {
		private $username;
		private $uuid;
		private $properties;
		/**
		* @param string $username The player's username.
		* @param string $uuid The player's UUID.
		* @param array $properties The player's properties specified on their Mojang profile.
		*/
		function __CONSTRUCT($username, $uuid, $properties = array()) {
			$this->username = $username;
			$this->uuid = $uuid;
			$this->properties = $properties;
		}
		/**
		* @return string The player's username.
		*/
		public function getUsername() {
			return $this->username;
		}
		/**
		* @return string The player's UUID.
		*/
		public function getUUID() {
			return $this->uuid;
		}
		/**
		* @return array The player's properties listed on their mojang profile.
		*/
		public function getProperties() {
			return $this->properties;
		}
		/**
		* @return array Returns an array with keys of 'properties, usernname and uuid'.
		*/
		public function getProfileAsArray() {
			return array("username" => $this->username, "uuid" => $this->uuid, "properties" => $this->properties);
		}
	}
?>
