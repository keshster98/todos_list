<?php
  // Collect database info
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

  // Get students data from the database

  // SQL Command (Recipe)
  $sql = "SELECT * FROM todos";
  // Prepare SQL query (Prepare Ingredients)
  $query = $database->prepare($sql);
  // Execute SQL query (Cook)
  $query->execute();
  // Fetch results (Eat)
  $todos = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Todo List App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div class="card rounded shadow-sm" style="max-width: 500px; margin: 60px auto;">
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <!-- Iterate through the todos table to print out tasks -->
          <?php foreach($todos as $index => $tasks) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <form method = "POST" action="update_todos.php">
                <input type="hidden" name="task_status" value="<?= $tasks["completed"]; ?>" />
                <input type="hidden" name="label_id" value="<?= $tasks["id"]; ?>" />
                  <!-- If task status = 1 (complete), then colour the box as green with a checkmark and strikethrough text-->
                  <?php if ($tasks["completed"] == 1) : ?>
                    <button class="btn btn-sm btn-success"><i class="bi bi-check-square"></i></button>
                    <span class="ms-2"><del><?= $index+1?>. <?=$tasks["label"]?></del></span>
                  <!-- If task status = 0 (incomplete), then colour the box as white without the checkmark -->
                  <?php else : ?>
                    <button class="btn btn-sm"><i class="bi bi-square"></i></button>
                    <span class="ms-2"><?= $index+1?>. <?=$tasks["label"]?></span>
                  <?php endif; ?>
                </form>
              </div>
              <div>
                <form method = "POST" action="delete_todos.php">
                  <input type="hidden" name="task_id" value="<?= $tasks["id"]; ?>" />
                  <!-- Delete task button -->
                  <button class="btn btn-sm btn-danger">
                      <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="mt-4">
          <!-- Add task text area -->
          <form class="d-flex justify-content-between align-items-center" method = "POST" action = "add_todos.php">
            <input type ="text" class ="form-control" placeholder ="Add new item..." name = "new_task"/>
            <!-- Add task button -->
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
