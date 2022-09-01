<?php
require_once "Models/Base.php";

$table = "sessions";
$columns = ["id_manager"];
$primary_column = "id";

$Session = Model($conn, $table, $primary_column, $columns);

$Session['end'] = function($total_card, $total_cash, $date_end) use ($conn, $table){
    $sql = "UPDATE $table SET 'card_total' = '$total_card', 'cash_total' = '$total_cash', 'date_end' = ".date("Y-m-d h:i:s");

    $result = $conn->query($sql);

    return $result;
}





?>