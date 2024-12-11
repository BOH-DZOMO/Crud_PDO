<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
require_once "database.php";
$id = $_GET["id"];

$read_sql = "SELECT departmentName, description FROM department WHERE departmentId = ? ";
$result_sql = $handler->prepare($read_sql);
$result_sql->execute(array($id));
$result = $result_sql->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $update_sql = "UPDATE department SET departmentName = ?, description = ? WHERE departmentId = ?";
    $update_result = $handler->prepare($update_sql);
    $update_result->execute(array($name, $description, $id));
    $affectedRows = $update_result->rowCount();
    if ($affectedRows > 0) {
        echo '<script>alert("Update successful"); window.location.href = "index2.php";</script>';
    } else {
        echo '<script>alert("No rows affected"); window.location.href = "index2.php";</script>';
    }
}


?>

<body>
    <div class="container-fluid">
        <nav>
            <div class="row p-2">
                <div class="col-3"><a href="./index1.php">Specialty</a></div>
                <div class="col-3"><a href="./index2.php">Department</a></div>
                <div class="col-3"><a href="./display1.php">Display Specialty</a></div>
                <div class="col-3"><a href="./display2.php">Display Department</a></div>
            </div>
        </nav>
        <h3>Edit Department Data</h3>
        <div class="">
            <div class="mb-3">
                <form action="" method="post">
                    <label for="DepartmentName" class="form-label">Department Name</label>
                    <input type="text" class="form-control" id="DepartmentName" name="name" value="<?php echo $result["departmentName"] ?>">
                    <div class="mb-3">Description</label>
                        <textarea class="form-control" id="description" rows="2" name="description"><?php echo $result["description"]?></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success me-2" name="submit">SUBMIT</button>
                        <button type="reset" class="btn btn-outline-danger">RESET</button>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>