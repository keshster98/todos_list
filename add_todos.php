<?php
  $host = 'localhost'; 
  $database_name = "todos_list"; 
  $database_user = "root";
  $database_password = "123";

  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password 
  );

  // Storing new task name into $task
  $task = $_POST["new_task"];
    
  // Check whether the user inserts a name
  if(empty($task)){
    // Send alert message if user does not insert a name
    echo '<script>alert("Please insert a task!");history.go(-1);</script>';
  }
  else{
      // If there is a name, add the name to database

      // SQL Command (Recipe)
      $sql = 'INSERT INTO todos (`label`) VALUES (:task)'; //:name where : acts as a placeholder, haven't used the variable yet.

      // Prepare SQL query (Prepare Ingredients)
      $query = $database->prepare($sql);

      // Execute SQL query (Cook)
      $query->execute([
          'task' => $task // The 
      ]);

      // Redirect user back to index.php after the process
      header("Location: index.php");
      exit;
  }
?>

