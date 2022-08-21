<?php
include "Models/Base.php";

$table = "managers";
$columns = ["login", "password"];
$primary_column = "id";

$Manager = Model($conn, $table, $primary_column, $columns);


$Manager['getId'] = function($manager_login){
    $sql = "SELECT id FROM $table WHERE login = '$manager_login'";

    $result = $db_con->query($sql);
    $return = [];

    while($row = $result->fetch_assoc()) {
        $return[] = $row;
    }

    return $return;
}




?>