<?php require "parts/header.php"; ?>
  <div class="card rounded shadow-sm" style="max-width: 500px; margin: 60px auto;">
    <div class="card-body">
      <h3 class="card-title mb-3">My Todo List</h3>
      <?php if (isset( $_SESSION['user'])) : ?>
        <?php
          // connect to the database
          $database = connectToDB();
          // load the data
          // SQL command (recipe)
          $sql = "SELECT * FROM todos WHERE user_id = :user_id";
          // prepare (prepare your material)
          $query = $database->prepare( $sql );
          // execute (cook)
          $query->execute([
            "user_id" => $_SESSION['user']['id']
          ]);
          // fetch all (eat)
          $todos = $query->fetchAll();
        ?>
      <!-- Logged in user -->
        <h4 class="mb-4">Welcome back, <?= $_SESSION['user']['name']; ?>!</h4>
        <ul class="list-group">
          <!-- Iterate through the todos table to print out tasks -->
          <?php foreach($todos as $index => $tasks) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <form method="POST" action="/tasks/update">
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
                <form method="POST" action="/tasks/delete">
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
      <!-- Non-logged in user -->
      <?php else : ?>
        <!-- Login button -->
        <a href="/login" class="btn btn-success" style="text-decoration: none; color: white">Login</a>
        <!-- Sign up button -->
        <a href="/signup" class="btn btn-primary" style="text-decoration: none; color: white">Sign Up</a>
      <?php endif; ?>
      <!-- Logged in user -->
      <?php if(isset($_SESSION['user'])) : ?>
        <div class="mt-4">
          <!-- Prints error message, if any when adding task -->
          <?php require "parts/error_box.php"; ?>
          <!-- Add task text area -->
          <form class="d-flex justify-content-between align-items-center" method = "POST" action = "/tasks/add">
            <input type ="text" class ="form-control" placeholder ="Add new item..." name = "new_task"/>
            <!-- Add task button -->
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- Logged in user -->
  <?php if(isset($_SESSION['user'])) : ?>
  <div class="d-flex justify-content-center align-items-center">
    <!-- Logout button  -->
    <button class="btn btn-danger"><a style="text-decoration: none; color: inherit" href="/logout">Logout</a></button>
  </div>
  <?php endif; ?>
<?php require 'parts/footer.php'; ?>
    