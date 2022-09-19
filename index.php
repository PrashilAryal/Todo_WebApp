<?php
  include('./db_config.php');

  $sql = "SELECT * FROM todo_list";
  $result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODO WebApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <?php require_once 'todo-changes.php'; ?>
    <?php
      if(isset($_SESSION['message'])){ ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
        </div>
        <?php } ?>

    <div class="container">
      <form method="POST" action="todo-changes.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <h1 class="text-center mt-5">ToDo Application</h1>
        <div class="form-group">
        <input type="text" class="form-control" name="todo" value="<?php echo $title ?>" placeholder="Add todo">
        </div>
        <div class="form-group">
          <?php
            if($update == true){ ?>
              <button type="submit" class="btn btn-info mt-2" name="update">Update ToDo</button>

            <?php
            }else{ 
              ?>
        <button type="submit" class="btn btn-primary mt-2" name="save">Add ToDo</button>

            <?php }
          ?>
        </div>
      </form>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Todo Item</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
              <td><?php echo $row['ID'] ?></th>
              <td><?php echo $row['title'] ?></td>
              <td><a href="todo-changes.php?deleteID=<?php echo $row['ID']; ?>" class="btn btn-danger">Remove</a>
              <a href="index.php?updateID=<?php echo $row['ID']; ?>" class="btn btn-success">Update</a></td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>