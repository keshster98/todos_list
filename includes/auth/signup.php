<?php
    // Connecting to database
    $database = connectToDB();
    // Storing the details the user has entered in the sign-up page
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    // Check if the user has filled all fields
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        setError("Please ensure all the fields are filled up!", "/signup");
    // Check if the user's password matches the confirm password
    } else if($password !== $confirm_password){
        setError("Your password does not match the confirmation, try again!", "/signup");
    // Check if the password is at least 8 characters long or more
    } else if(strlen($password) < 8){
        setError("Please ensure your password is 8 characters or more!", "/signup");
    // Update the database with the new user and their details if all above checks have passed
    } else {
        // Check if email has already been used before
        // SQL Command (Recipe)
        $sql = "SELECT * FROM users WHERE email = :email";
        // Prepare SQL query (Prepare Ingredients)
        $query = $database->prepare($sql);
        // Execute SQL query (Cook)
        $query->execute([
            'email' => $email
        ]);
        // Fetch (Eat)
        $user = $query->fetch(); // Returns the first row starting from the query row
        // Send alert message if email already exists
        if($user){
            setError("Email already in use. Please use another email!", "/signup");
        }
        // Process sign up if otherwise
        else {
            // SQL Command (Recipe)
            $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
            // Prepare SQL query (Prepare Ingredients)
            $query = $database->prepare($sql);
            // Execute SQL query (Cook)
            $query->execute([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
            // Redirect user back to login.php after the process
            echo '<script>alert("Successfully signed up!");window.location.href="/login"</script>';
        }
    }
?>