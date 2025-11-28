<!DOCTYPE html>
<?php
include 'db.php';
if (isset($_POST['search']) && !empty($_POST['search'])) {
   $task_name = htmlspecialchars($_POST['search']);
   $search_term = $conn->real_escape_string($task_name);
   $sql = "SELECT * FROM tasks WHERE name LIKE '%$search_term%'";
   $rows = $conn->query($sql);
} else {
    $sql = "SELECT * FROM tasks";
    $rows = $conn->query($sql);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP TODO APP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <!-- Main Container -->
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <!-- Title -->
            <h1 class="text-center">To do list</h1>
            <div class="col-md-12">

                <!-- Task Table -->
                <table class="table table-hover">

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_task_modal">
                        Add Task
                    </button>

                    <br>
                    <hr>

                    <!-- Modal -->
                    <div class="modal fade" id="add_task_modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-inline" method="post" action="add.php">
                                        <div class="form-group mb-3">
                                            <label class="control-label" for="task_name">Task Name</label>
                                            <input type="text" required name="task" class="form-control" id="task_name" placeholder="Enter task">

                                        </div>
                                        <input type="submit" name="send" class="btn btn-success btn-block" value="Add Task">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Search Form -->
            <form class="form-inline" method="post" action="">
                <div class="form-group mb-3">
                    <input type="text" name="search" class="form-control" id="search" placeholder="Search tasks" >
                </div>
            </form>
            <?php if(mysqli_num_rows($rows) == 0){ ?>
                <h3 class="text-center">No tasks found</h3>
            <?php } ?>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Task</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php while ($row = $rows->fetch_assoc()) { ?>
                        <td><?php echo $row['id']; ?></td>
                        <td class="col-md-10"><?php echo $row['name']; ?></td>
                        <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a></td>
                        <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php } ?>
            </tbody>

            </table>

            <!-- Cancel Button -->
            <div class="modal-footer justify-content-left">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.href='index.php'">Back</button>
            </div>

        </div>

</body>

</html>