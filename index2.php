<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
require_once "database.php";

function validate($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
$error ="";

if (isset($_POST["submit"])) {
    if (!(empty($_POST["name"]) or empty($_POST["description"]))) {
        $name = validate($_POST["name"]);
        $description = validate($_POST["description"]);
        $insert_sql = "INSERT INTO department( departmentName, description) VALUES (?,?)";
        $insert_result = $handler->prepare($insert_sql);
        $insert_result->execute(array($name, $description));
        $affectedRows = $insert_result->rowCount();
        if ($affectedRows > 0) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data was successfully added(Operation successfull)
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        } else {
            echo '<script>alert("Operation Unsuccesssfull");</script>';
        }
    }
    else {
        $error="one or two inputs are not filled";
    }
}


?>

<body>
    <div class="container-fluid">
        <nav>
            <div class="row p-2">
                <div class="col-3"><a href="./index1.php">Specialty</a></div>
                <div class="col-3">Department</div>
                <div class="col-3"><a href="./display1.php">Display Specialty</a></div>
                <div class="col-3"><a href="./display2.php">Display Department</a></div>
            </div>
        </nav>
        <h3>New Department</h3>
        <div class="">
            <div class="mb-3">
                <form action="" method="post">
                    <label for="DepartmentName" class="form-label">Department Name</label>
                    <input type="text" class="form-control" id="DepartmentName" name="name">
                    <div class="mb-3">Description</label>
                        <textarea class="form-control" id="description" rows="2" name="description"></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success me-2" name="submit">SUBMIT</button>
                        <button type="reset" class="btn btn-outline-danger">RESET</button>
                    </div>
                </form>
            </div>
            <div><?php echo $error;?></div>
        </div>
</body>

</html>