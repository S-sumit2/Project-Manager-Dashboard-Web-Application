<?php 

SESSION_START();
include 'db.php';

if (isset($_GET["id"])) {
    
    $p_id = $_GET["id"];
    $sql = $conn->prepare("delete from projects where p_id = ?");
    $sql->bind_param("i",$p_id);

    if ($sql->execute()) {
        header("Location:home.php");
    }else{
        echo "<script>alert('Failed to delete')</script>";
        exit();
    }

}

?>