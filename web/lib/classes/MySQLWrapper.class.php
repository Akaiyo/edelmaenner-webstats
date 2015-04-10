<?php

class MySQLWrapper {
	public $db;
	private $result;

	function __construct($host, $username, $passsword, $database){
		$this->db = new mysqli($host, $username, $passsword, $database);
		if($this->db->connect_error){
			die('MySQL Verbindungsfehler ('. $this->db->connect_errno .' - '. $this->db->connect_error .')');
		}
		$this->result = false;
	}
	
	function free(){
		if($this->result !== false){
			if(is_object($this->result)){
				$this->result->free();
			}
			$this->result = false;
			return true;
		}
		return false;
	}
	
	function update ($query){
		$data = $this->query($query);
		if($data){
			return $data;
		}
	}
	
	function query($query){
		$this->free();
		$this->db->query('SET NAMES utf8;');
		$this->result = $this->db->query($query);
		
	}
	
	function query_one($query){
		$this->query($query);
		if($this->result){
			return $this->result->fetch_assoc();
			$this->free();
		}
		return false;
	}
	
	function query_all($query){
		$this->query($query);
		if($this->result){
			$return = array();
			while(($row = $this->result->fetch_assoc()) !== NULL){
				$return[] = $row;
			}
			$this->free();
			return $return;
		}
		return false;
	}
	
	function escape($string){
		return $this->db->real_escape_string($string);
	}
	
	
	function __destruct(){
		$this->db->close();
	}
	

}