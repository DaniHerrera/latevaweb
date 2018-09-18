<?php

class serverConfig{

  private $servername = "localhost";
  private $username = 'root';
  private $password = '';
  private $dbname = 'blog';
  private $serverStatements = array();

  public function allConfig(){
  	array_push($this->serverStatements,$this->servername,$this->username,$this->password,$this->dbname);
  	return $this->serverStatements;
  }

}

?>