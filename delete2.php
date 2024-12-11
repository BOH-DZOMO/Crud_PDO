<?php
require_once "database.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $delete_sql = ("UPDATE `department` SET `departmentS`='disabled' WHERE departmentId = ?");
    $delete_result = $handler->prepare($delete_sql);
    $delete_result->execute(array($id));
    $affectedRows = $delete_result->rowCount();
    if ($affectedRows > 0) {
        echo '<script>alert("Deletion successful"); window.location.href = "display2.php";</script>';
    } else {
        echo '<script>alert("No rows affected"); window.location.href = "display2.php";</script>';
    }

}
?>