<!DOCTYPE html>

<?php
include 'db.php';
$id = (int)$_GET['id'];

$sql = "SELECT * FROM tasks WHERE id='$id'";
$rows = $conn->query($sql);
$row = $rows->fetch_assoc();

if (isset($_POST['send'])) {
    $task_name = htmlspecialchars($_POST['task']);
    $sql = "UPDATE tasks SET name='$task_name' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
    <div class="container">
        <div class="row" style="margin-top: 70px;">
            <div class="col-md-12 text-center">
                <h1>Update To do list item</h1>
            </div>
            <div class="col-md-12">
                <table class="table">

                    <form class="form-inline" method="post">
                        <div class="form-group mb-3">
                            <label class="control-label" for="task_name">Task Name</label>
                            <input type="text" required name="task" 
                            value="<?php echo $row['name']; ?>" 
                            class="form-control" id="task_name" placeholder="Enter task">
                        </div>
                        <input type="submit" name="send" class="btn btn-success" value="Update Task">
                        &nbsp;
                        <input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='index.php'">
                    </form>
            </div>

        </div>
    </div>

</body>

</html>