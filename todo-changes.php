<?php
include('./db_config.php');
session_start();
$id = 0;
$title = '';
$update = false;

if(isset($_POST['save'])){
    $todo_item = $_POST['todo'];

    $conn->query("INSERT INTO todo_list(`title`) VALUES('$todo_item')");

    $_SESSION['message'] = "'$todo_item' is added to list.";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}
if(isset($_GET['deleteID'])){
    $id = $_GET['deleteID'];
    $conn->query("DELETE FROM todo_list WHERE ID=$id");

    $_SESSION['message'] = "List removed successfully..";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['updateID'])){
    $id = $_GET['updateID'];
    $update = true;
    $result = $conn->query("SELECT * FROM todo_list WHERE ID=$id");
        $row = $result->fetch_array();
        $title = $row['title'];
    
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['todo'];

    $conn->query("UPDATE todo_list SET title='$title' WHERE ID='$id'");

    $_SESSION['message'] = "List have been updated with '$title'.";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}

?>