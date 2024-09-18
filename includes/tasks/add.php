<?php
  // Connecting to database
  $database = connectToDB();
  // Storing new task name
  $task = $_POST["new_task"];
  // Check whether the user inserts a task
  if(empty($task)){
    // Send alert message if user does not insert a task
    $_SESSION['error'] = "";
    header("Location: /");
    exit;
    setError("Please insert a task!", "/");
  }
  // Store task in the database if the above check has passed
  else{
    // SQL Command (Recipe)
    $sql = 'INSERT INTO todos (`label`, `user_id`) VALUES (:task, :user_id)';
    // Prepare SQL query (Prepare Ingredients)
    $query = $database->prepare($sql);
    // Execute SQL query (Cook)
    $query->execute([
        'task' => $task,
        'user_id' => $_SESSION['user']['id']
    ]);
    // Redirect user back to home.php after the process
    header("Location: /");
    exit;
  }
?>

