<?php

 class connectToDB
 {
	private $conn;
	public function __construct()
	{
		$config = include 'config.php';
		$this->conn = new mysqli( $config['db']['server'], $config['db']['user'], $config['db']['pass'], $config['db']['dbname']);
		// var_dump($config, $this->conn);
	}
	
	function __destruct()
	{
		$this->conn->close();
	}
	public function addCompany( $company, $latitude, $longitude, $obra_id)
	{
		  $statement = $this->conn->prepare("INSERT INTO mapa_marker( company, latitude, longitude, obra_id) VALUES( ?, ?, ?, ?)");
		  $statement->bind_param('ssss', $company, $latitude, $longitude, $obra_id);
		  $statement->execute();
		  $statement->close();
		  $this->conn->close();
	}
	public function getCompaniesList($id)
	{
		  $arr = array();
		  $statement = $this->conn->prepare( "SELECT id, company, details, latitude, longitude, telephone, keywords from mapa_marker where obra_id=$id order by company ASC");
		  $statement->bind_result( $id, $company, $details, $latitude, $longitude, $telephone, $keywords);
		  $statement->execute();
		  while ($statement->fetch()) {
			$arr[] = [ "id" => $id, "company" => $company, "details" => $details, "latitude" => $latitude, "longitude" => $longitude, "telephone" => $telephone, "keywords" => $keywords];
		  }
		  $statement->close();
		  
		  return $arr;
	}
	public function updateCompany( $id, $details, $latitude, $longitude, $telephone, $keywords)
	{
		  $statement = $this->conn->prepare("UPDATE mapa_marker SET details = ?,latitude = ?,longitude = ?,telephone = ?,keywords = ? where id = ?");
		  $statement->bind_param( 'sssssi', $details, $latitude, $longitude, $telephone, $keywords, $id);
		  $statement->execute();
		  $statement->close();
		  
	}
	public function deleteCompany($id)
	{
		 $statement = $this->conn->prepare("DELETE FROM mapa_marker WHERE id = ?");
		 $statement->bind_param('i', $id);
		 $statement->execute();
		 $statement->close();
		 
	}
	public function addStreet( $street, $geo, $obra_id)
	{
		 $statement = $this->conn->prepare("INSERT INTO mapa_ruta( name, geolocations, obra_id ) VALUES( ?, ?, ?)");
		 $statement->bind_param( 'sss', $street, $geo, $obra_id);
		 $statement->execute();
		 $statement->close();
		 
	}
	public function getStreetsList($id)
	{
		$arr = array();
		$statement = $this->conn->prepare( "SELECT id, name, geolocations, keywords from mapa_ruta where obra_id=$id order by name ASC");
		$statement->bind_result( $id, $name, $geolocations, $keywords);
		$statement->execute();
		while ($statement->fetch()) {
		$arr[] = [ "id" => $id, "name" => $name, "geolocations" => $geolocations, "keywords" => $keywords];
		}
		$statement->close();
		
		return $arr;
	}
	public function updateStreet( $id, $geo, $keywords)
	{
		  $statement = $this->conn->prepare( "UPDATE mapa_ruta SET geolocations = ?, keywords = ? where id = ?");
		  $statement->bind_param( 'ssi', $geo, $keywords, $id);
		  $statement->execute();
		  $statement->close();
		  
	}
	public function deleteStreet($id)
	{
		 $statement = $this->conn->prepare("DELETE FROM mapa_ruta WHERE id = ?");
		 $statement->bind_param('i', $id);
		 $statement->execute();
		 $statement->close();
		 
	}
	public function addArea( $area, $geo, $keywords)
	{
		  $statement = $this->conn->prepare( "INSERT INTO mapa_area( name, geolocations, keywords ) VALUES(?,?,?)");
		  $statement->bind_param( 'sss', $area, $geo,$keywords);
		  $statement->execute();
		  $statement->close();
		  
	}
	public function getAreasList()
	{
		  $arr = array();
		  $statement = $this->conn->prepare( "SELECT id, name, geolocations, keywords from mapa_area order by name ASC");
		  $statement->bind_result( $id, $name, $geolocations, $keywords);
		  $statement->execute();
		  while ($statement->fetch()) {
			$arr[] = [ "id" => $id, "name" => $name, "geolocations" => $geolocations, "keywords" => $keywords];
		  }
		  $statement->close();
		  
		  return $arr;
	}
	public function updateArea( $id, $geo, $keywords)
	{
		  $statement = $this->conn->prepare("UPDATE mapa_area SET geolocations = ?, keywords = ? where id = ?");
		  $statement->bind_param( 'ssi', $geo, $keywords, $id);
		  $statement->execute();
		  $statement->close();
		  
	}
	public function deleteArea($id)
	{
		 $statement = $this->conn->prepare("Delete from mapa_area where id = ?");
		 $statement->bind_param('i', $id);
		 $statement->execute();
		 $statement->close();
		 
	}
 }
 
 $conn = new connectToDB();