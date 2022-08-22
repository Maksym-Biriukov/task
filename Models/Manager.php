<?php
include "Models/Base.php";

$table = "managers";
$columns = ["login", "password"];
$primary_column = "id";

$Manager = Model($conn, $table, $primary_column, $columns);


$Manager['getId'] = function($manager_login) use ($conn, $table){
    $sql = "SELECT id FROM $table WHERE login = '$manager_login'";

    $result = $conn->query($sql);
    $return = [];

    while($row = $result->fetch_assoc()) {
        $return[] = $row;
    }

    if (count($return) == 0){
        return ['error' => "No manager found."];
    }

    return $return[0]['id'];
};

$Manager['getManager'] = function($manager_login) use ($conn, $table){
    $sql = "SELECT * FROM $table WHERE login = '$manager_login'";

    $result = $conn->query($sql);
    $return = [];

    while($row = $result->fetch_assoc()) {
        $return[] = $row;
    }

    if (count($return) == 0){
        return ['error' => "No manager found."];
    }

    return $return[0]['id'];
};




?>