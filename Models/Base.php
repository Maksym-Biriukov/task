<?php
function Model($db_con, $table, $idcol, $columns){
    
    $dbQueries = [
        'all'    => "SELECT * FROM $table;",
        'search' => "SELECT * FROM $table WHERE :param = ':param';",
        'insert' => "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES ( " . str_repeat("':param', ", count($columns) - 1) . "':param' );",
        'update' => "UPDATE $table SET " . implode(", ", array_map(function($col){
            return "$col = ':param'";
        }, $columns)) . " WHERE $idcol = ':cond';",
        "delete" => "DELETE FROM $table WHERE $idcol = ':cond'"
    ];

    $dbFuncs = [
        'all' => function() use ($db_con, $dbQueries){
            $sql = $dbQueries['all'];
            
            $result = $db_con->query($sql);
            $return = [];

            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }

            return $return;
        },
        'search' => function($values) use ($db_con, $dbQueries){
            $sql = $dbQueries['search'];

            if (count($values) != substr_count($sql, ":param")){
                return ['error' => 'Number of values does not match count of binds.'];
            }
            $params = array_reverse($values); 
            
            while(strpos($sql, ":param")){
                $sql = preg_replace("/\:param/", array_pop($params), $sql, 1);
            }
            // echo $sql;
            $result = $db_con->query($sql);
            $return = [];

            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }

            return $return;
        },
        'insert' => function($values) use ($db_con, $dbQueries){
            $sql = $dbQueries['insert'];
            $params = array_reverse($values); 
            
            while(strpos($sql, ":param")){
                $sql = preg_replace("/\:param/", "'".array_pop($params)."'", $sql, 1);
            }
            
            $result = $db_con->query($sql);

            return $result;
        },
        'update' => function($values, $cond) use ($db_con, $dbQueries){
            $sql = $dbQueries['update'];
            $params = array_reverse($values); 
            
            while(strpos($sql, ":param")){
                $sql = preg_replace("/\:param/", "'".array_pop($params)."'", $sql, 1);
            }
            $sql = preg_replace("/\:cond/", $cond, $sql);
            $result = $db_con->query($sql);

            return $result;
        },
        'delete' => function($cond) use ($db_con, $dbQueries){
            $sql = $dbQueries['delete'];

            $sql = preg_replace("/\:cond/", $cond, $sql);

            $result = $db_con->query($sql);

            return $result;
        },
        'query' => function($sql) use ($db_con){
            $result = $db_con->query($sql);

            return $result;
        }
    ];

    return $dbFuncs;
}
?>