<?php
  // Connecting to database
  $database = connectToDB();
  // Storing the id of the task to be deleted
  $task_id = $_POST["task_id"];
  // Delete the selected task
  // SQL Command (Recipe)
  $sql = "DELETE FROM todos where id = :id";
  // Prepare SQL query (Prepare Ingredients)
  $query = $database->prepare($sql);
  // Execute SQL query (Cook)
  $query->execute([
      'id' => $task_id
  ]);
  // Redirect user back to home.php after the process
  header("Location: /");
  exit;
?>