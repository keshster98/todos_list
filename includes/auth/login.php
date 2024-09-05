<?php
    // Connecting to database
    $database = connectToDB();
    // Storing the details the user has entered in the login page
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Check if the user has filled all fields
    if(empty($email) || empty($password)){
        $_SESSION['error'] = "Please ensure all fields are filled!";
        header("Location: /login");
        exit;
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
            if (password_verify($password, $user["password"])) {
                // Login the user if the above check has passed
                $_SESSION["user"] = $user;
                // Redirect the user back to home.php after the process
                echo '<script>alert("Successfully logged in!");window.location.href="/"</script>';
                exit;
            // If the password is wrong
            } else {
                $_SESSION['error'] = "The password is incorrect, try again!";
                header("Location: /login");
                exit;
            }
        // If the email is not in the database
        } else {
            $_SESSION['error'] = "Email does not exist, try again!";
            header("Location: /login");
            exit;
        }
    }
?>