<?php
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

  // Storing new task name
  $task = $_POST["new_task"];
    
  // Check whether the user inserts a task
  if(empty($task)){
    // Send alert message if user does not insert a task
    echo '<script>alert("Please insert a task!");history.go(-1);</script>';
  }
  // Store task in the database if the above check has passed
  else{
      // SQL Command (Recipe)
      $sql = 'INSERT INTO todos (`label`) VALUES (:task)';
      // Prepare SQL query (Prepare Ingredients)
      $query = $database->prepare($sql);
      // Execute SQL query (Cook)
      $query->execute([
          'task' => $task
      ]);
      // Redirect user back to index.php after the process
      header("Location: index.php");
      exit;
  }
?>

