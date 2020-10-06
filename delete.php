<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "edb");

if (isset($_POST['delete_d']))
 {
    $id = $_POST['delete_id'];

     $query = "DELETE FROM fresh WHERE id='$id' ";

     $query_run = mysqli_query($con, $query);

     if ($query_run)
     {
        $_SESSION['status'] = "Deleted";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "something went wrong";
        header('location: index.php');
    } 



 }

?>