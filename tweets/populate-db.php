<?php
use \tweets\classes\DB;

require_once 'init.php';

$db = DB::getInstance();

try {
    $sql = "INSERT INTO tweets (text, user_id, public)
            VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?)";

    $stmt = $db->pdo->prepare($sql);

    $stmt->execute(
        array(
            'Lorem ipsum dolor sit amet...', 1, 1,
            'No entanto, não podemos esquecer que...', 1, 0,
            'As experiências acumuladas demonstram...', 2, 1
        )
    );
} catch (PDOException $e) {
    echo $e->getMessage();
  }
