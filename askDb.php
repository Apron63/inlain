<?php

require_once 'db.php';

$term = htmlspecialchars_decode($_GET['term']);

if (!empty($term)) {
    $result = [];
    $sql = "SELECT p.title, c.body 
            FROM post p 
            JOIN comment c ON c.postId = p.id 
            WHERE c.body LIKE '%{$term}%' 
            ORDER BY p.id
            ";
    $stmt = $dbcon->query($sql);
    while ($row = $stmt->fetch()) {
        $result[] = [
            'title' => $row['title'],
            'body' => $row['body'],
        ];
    }

    echo json_encode($result);
}