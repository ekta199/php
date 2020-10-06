<?php

session_start();
$con = mysqli_connect("localhost", "root", "", "edb");




if (isset($_POST['saveadd'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $publish = $_POST['publish'];
    $stock = $_POST['stock'];

    $q = " INSERT INTO fresh (title,author,publish,stock) values ('$title', '$author', '$publish', '$stock')";

    $query = mysqli_query($con, $q);



    if ($query) {
        $_SESSION['status'] = "saved";
        header('location: index.php');
    } else {
        $_SESSION['status'] = " not saved";
        header('location: index.php');
    }
}

//viewbtn
if (isset($_POST['checking_viewbtn'])) {
    $s_id = $_POST['student_id'];
    // echo $return =  $s_id;
}
$que = " SELECT*FROM fresh  WHERE id = '$s_id' ";

$query_run = mysqli_query($con, $que);

if (mysqli_num_rows($query_run) > 0) {

    foreach ($query_run as $row) {
        echo $return = '
     <h5> id: ' . $row['id'] . '</h5>
     <h5> title: ' . $row['title'] . '</h5>
     <h5> author: ' . $row['author'] . '</h5>
     <h5> publish: ' . $row['publish'] . '</h5>
     <h5> stock: ' . $row['stock'] . '</h5>
    
    ';
    }
} else {
    echo  $return = "<h3>no record found </h3>";
}


if (isset($_POST['editadd'])) {
    $id = $_POST['edit_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publish = $_POST['publish'];
    $stock = $_POST['stock'];

    $query = "UPDATE fresh SET  title='$title', author='$author', publish='$publish' , stock=' $stock' WHERE id='' ";
    $query_run = mysqli_query($con, $q);

    if ($query_run) {
        $_SESSION['status'] = "saved";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "not saved";
        header('location: index.php');
    }
}


?>