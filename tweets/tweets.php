<?php

use mysys\classes\DB;

require_once 'init.php';

try {
    $sql = "SELECT t.text, u.username
              FROM tweets t
              JOIN users u ON u.id = t.user_id
             WHERE t.public = 1
               AND u.id = 1 ";

    if (isset($_POST['submit'])) {
        $sql .= "AND t.text ~* '{$_POST['desc']}' ";
    }

    $db = DB::getInstance();

    $db->getList($sql);

    $tweets = $db->getResults();

    include 'views/list-tweets.php';
} catch (PDOException $e) {
    echo $e->getMessage();
}
