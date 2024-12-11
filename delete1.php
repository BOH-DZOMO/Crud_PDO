<?php
require_once "database.php";
if (isset($_POST["specialtyId"])) {
    $id = $_POST["specialtyId"];
    $delete_sql = ("UPDATE `specialty` SET `specialtyS`='disabled' WHERE specialtyId = ?");
    $delete_result = $handler->prepare($delete_sql);
    $delete_result->execute(array($id));
    $affectedRows = $delete_result->rowCount();
    $flag ="";
    if ($affectedRows > 0) {
        $flag = 'success';
    } else {
        $flag = 'failure';
    }
    echo json_encode($flag);
}
?>