<?php
Class DbConnection{
    function getdbconnect(){
        $conn = mysqli_connect("localhost","root","","e_food") or die("Couldn't connect");
        return $conn;
    }
}
?>