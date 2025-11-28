<?php
include 'db.php';

if (isset($_GET['id'])) {
    $task_id = (int)$_GET['id'];
    $sql = "DELETE FROM tasks WHERE id='$task_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>