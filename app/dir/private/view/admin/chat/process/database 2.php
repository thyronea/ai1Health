<?php
include('../../../../security/dbcon.php');

Class Database {

    private $con;

    function _construct() {
        $this->con = $this->connect();
    }
    
    private function connect() {
        $string = "mysql:host=mariadb;dli";
        try{
            $connection = new PDO($string, $username, $password);
            return $connection;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die;
        }

        return false;

    }

    public function write($query, $data_array = []){
        $userID = mysqli_real_escape_string($con, $_SESSION['userID']);
        $con = $this->connect();
        $stmt = $con->prepare($query);

        foreach ($data_array as $key => $value) {
            $stmt->bind_param(':'.$key, $value);
        }
        $check = $stmt->execute();
        if($check){
            return true;
        }
        return false;
    }
}