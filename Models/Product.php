<?php
require_once "Models/Base.php";

$table = "products";
$columns = ["count", "cost", "name"];
$primary_column = "id";

$Product = Model($conn, $table, $primary_column, $columns);







?>