<?php

define("HOST", "fdb21.awardspace.net"); 
define("USER", "2714099_ariane");
define("PASSWORD", "11411bcc046"); 
define("DATABASE", "2714099_ariane");

function conectaAoMySQL()
{
  $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if ($conn->connect_error)
    throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);

  return $conn;   
}

?>