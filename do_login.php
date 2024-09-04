<?php
    // Start session for login
    session_start();
    // Connecting to database
    $host = 'localhost';
    $database_name = "todos_list";
    $database_user = "root";
    $database_password = "123";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // Storing the details the user has entered in the login page
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user has filled all fields
    if(empty($email) || empty($password)){
        echo '<script>alert("Please ensure all fields are filled!");window.location.href="login.php"</script>';
    // Carry out login process if the above check has passed
    } else {
        // Check if the email entered is in the database

        // SQL Command (Recipe)
        $sql = "SELECT * FROM users WHERE email = :email";
        // Prepare SQL query (Prepare Ingredients)
        $query = $database->prepare($sql);
        // Execute SQL query (Cook)
        $query->execute([
            'email' => $email
        ]);
        // Fetch results (Eat)
        $user = $query->fetch();
        
        // Check if the user exists in the database
        if ($user) {
            // Check if the password is correct
            if ( password_verify( $password, $user["password"] ) ) {
                // Login the user if the above check has passed
                $_SESSION["user"] = $user;
                // Redirect the user back to index.php after the process
                echo '<script>alert("Successfully logged in!");window.location.href="index.php"</script>';
                exit;
            // If the password is wrong
            } else {
                echo '<script>alert("The password is incorrect, try again!");window.location.href="login.php"</script>'; 
            }
        // If the email is not in the database
        } else {
            echo '<script>alert("Email does not exist, try again!");window.location.href="login.php"</script>';
        }
    }
?>