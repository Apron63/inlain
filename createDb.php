<?php

require_once 'db.php';

if (null === $dbcon) {
    exit(1);
}

$sql = 'CREATE TABLE IF NOT EXISTS `post` ( 
            `id` INT NOT NULL AUTO_INCREMENT, 
            `userId` INT NOT NULL, 
            `title` VARCHAR(255) NOT NULL, 
            `body` VARCHAR(1000) NOT NULL, 
            PRIMARY KEY (`ID`))
        ';
$dbcon->exec($sql);
echo 'Table POST has been created.' . PHP_EOL;

$sql = 'CREATE TABLE IF NOT EXISTS `comment` ( 
            `id` INT NOT NULL AUTO_INCREMENT, 
            `postId` INT NOT NULL, 
            `name` VARCHAR(255) NOT NULL, 
            `email` VARCHAR(255) NOT NULL, 
            `body` VARCHAR(1000) NOT NULL, 
            PRIMARY KEY (`ID`))
        ';
$dbcon->exec($sql);
echo 'Table COMMENT has been created.' . PHP_EOL;