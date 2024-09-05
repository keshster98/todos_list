<?php
    function connectToDB() {
        // Setup database credential
        $host = 'localhost'; // For Windows user
        $database_name = "todos_list"; // Connecting to a specific database 
        $database_user = "root"; // MySQL Username
        $database_password = "123"; // MySQL Password
        // Connect to database (PDO - PHP database object)
        $database = new PDO(
            "mysql:host=$host;dbname=$database_name",
            $database_user, 
            $database_password 
        );
        return $database;
    }
?>