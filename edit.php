<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "edb");



//editbtn
if (isset($_POST['checking_edit_btn'])) {
    $n_id = $_POST['book_id'];
    //echo $return =  $s_id;

    $result_array = [];


    $quer = " SELECT*FROM fresh  WHERE id= '$n_id' ";

    $query_runn = mysqli_query($con, $quer);

    if (mysqli_num_rows($query_runn) > 0) {

        foreach ($query_runn as $row) {
            array_push($result_array, $row);
            header('content-type:application/json');
            echo json_encode($result_array);
        }
    } else {
        echo  $return = "<h5>no record found </h5>";
    }
}


if (isset($_POST['update_btn']))
 {
    $id = $_POST['edit_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publish = $_POST['publish'];
    $stock = $_POST['stock'];

    $queryy = "UPDATE fresh SET title='$title', author='$author', publish='$publish' , stock=' $stock' WHERE 
    id='$id' ";



    $query_r = mysqli_query($con, $queryy);

    if ($query_r)
     {
        $_SESSION['status'] = "updated";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "something went wrong";
        header('location: index.php');
    }
}




?>