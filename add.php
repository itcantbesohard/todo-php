<?php
include 'db.php';

if(isset($_POST['send'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $task_name = htmlspecialchars($_POST['task']);
        $sql = "INSERT INTO tasks (name) VALUES ('$task_name')";
        $val = $conn->query($sql);
        if ($val) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>