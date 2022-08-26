<?php
require_once "Models/Base.php";

$table = "sessions";
$columns = ["id_manager", "cash_total", "card_total", "date_end"];
$primary_column = "id";

$Session = Model($conn, $table, $primary_column, $columns);







?>