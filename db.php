<?php

class Database{


public function connect(){

$conn = new mysqli("localhost","root","1234","journal_db");

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}
return $conn;


}

}

$db = new Database();
$conn = $db->connect();



?>