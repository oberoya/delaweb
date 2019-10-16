<?php
    try {
        $pdo = new PDO ('pgsql:host=localhost;dbname=test', 'postgres','a');
        echo 'u dont suck';
    } catch (PDOException $e) {
        echo 'you suck';
    }
?>