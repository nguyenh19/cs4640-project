<?php

        $db = new Database();
        //$category = $_POST["category"];
        $user = $db->query("select id from users where email = ?;", "s", $_SESSION["email"]);
        $array = $db->query("select * from clothing where (user_id = ?) and (category = ?);", "is", $user[0]["id"], "Shirt");
        $rows = array();
        foreach ($array as $i) {
            $rows[] = $i;
        }
        $json_clothes = json_encode($rows);
        echo $json_clothes;

