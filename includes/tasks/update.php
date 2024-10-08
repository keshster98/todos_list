<?php
  // Connecting to database
  $database = connectToDB();
  // Store the task status and label id
  $task_status = $_POST["task_status"];
  $label_id = $_POST["label_id"];
  // Check exisiting status of task in database
  // 0 = not complete, 1 = complete
  // Make status changes upon box click
  if ($task_status == 0){
    $task_status = 1;
  } else {
    $task_status = 0;
  }
  // Update task based on if/else statement outcome
  // SQL Command (Recipe)
  $sql = "UPDATE todos SET completed = :task_status WHERE id = :label_id";
  // Prepare SQL query (Prepare Ingredients)
  $query = $database->prepare($sql);
  // Execute SQL query (Cook)
  $query->execute([
      'task_status' => $task_status,
      'label_id' => $label_id
  ]);        
  // Redirect user back to home.php after the process
  header("Location: /");
  exit;
?>