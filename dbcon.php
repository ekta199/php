<?php

$server = "localhost";
$user="root";
$password="";
$db="edb";
$con ="mysqli_connect($server,$user,$password,$db)";

if($con){
    ?>
    <script>
    alert('connected');
    </script>
    <?php
}else{

    ?>
    <script>
    alert('not connected');
    </script>
    <?php

}


?>