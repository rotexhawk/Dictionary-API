<?php
$dsn = "mysql:dbname=dictionary;host=localhost";
$username = "username";
$password = "password";
$pdo = new PDO($dsn, $username, $password);
$db = new NotORM($pdo);