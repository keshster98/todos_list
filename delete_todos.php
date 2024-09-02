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

  // Storing the id of the task to be deleted
  $task_id = $_POST["task_id"];

  // SQL Command (Recipe)
  $sql = "DELETE FROM todos where id = :id";

  // Prepare SQL query (Prepare Ingredients)
  $query = $database->prepare($sql);

  // Execute SQL query (Cook)
  $query->execute([
      'id' => $task_id
  ]);

  // Redirect user back to index.php after the process
  header("Location: index.php");
  exit;
?>