<?php

use tweets\classes\DB;

require_once 'init.php';
require_once 'lib.php';

try {
    $db = DB::getInstance();

    $sql = "SELECT t.text, u.username
              FROM tweets t
              JOIN users u ON u.id = t.user_id
             WHERE t.public = 1 ";

    $arrParam = array();

    if (isset($_POST['submit'])) {
        $sql .= "AND t.text ~* :text ";
        $arrParam = array(
            array('name' => ':text', 'value' => $_POST['text'])
        );
    }

    $ord = filter_input(INPUT_GET, 'ord', FILTER_SANITIZE_SPECIAL_CHARS);
    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($ord) {
        if ($dir != 'ASC' && $dir != 'DESC') {
            $dir = 'ASC';
        }

        $res = $db->pdo->query('SELECT * FROM tweets LIMIT 0');
        $orderBy = '';

        for ($i = 0; $i < $res->columnCount(); $i++) {
            $col = $res->getColumnMeta($i)['name'];
            if ($col == $ord) {
                $orderBy = $ord;
                break;
            }
        }

        if (!strlen($orderBy)) {
            $orderBy = 'id';
        }

        $sql .= " ORDER BY {$orderBy} {$dir}";
    }

    $db->getList($sql, $arrParam);

    $tweets = $db->getResults();

    include 'views/list-tweets.php';
} catch (PDOException $e) {
    echo $e->getMessage();
}
