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

$read_sql = "SELECT departmentId, departmentName FROM department WHERE departmentS = 'active' ";
$read_result = $handler->prepare($read_sql);
$read_result->execute();

if (isset($_POST["submit"])) {
    $SpecName = validate($_POST["SpecName"]);
    $depId =  validate($_POST["depId"]);
    $description = validate($_POST["description"]);
    $insert_sql = "INSERT INTO specialty(specialtyName,departmentId,description) VALUES (?,?,?)";
    $insert_result = $handler->prepare($insert_sql);
    $insert_result->execute(array($SpecName, $depId, $description));
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



?>

<body>
    <div class="container-fluid">
        <nav>
            <div class="row p-2">
                <div class="col-3">Specialty</div>
                <div class="col-3"><a href="./index2.php">Department</a></div>
                <div class="col-3"><a href="./display1.php">Display Specialty</a></div>
                <div class="col-3"><a href="./display2.php">Display Department</a></div>
            </div>
        </nav>
        <h3>New Specialty</h3>
        <div class="">
            <div class="mb-3">
                <form action="" method="post">
                    <label for="SpecialtyName" class="form-label">Specailty Name</label>
                    <input type="text" class="form-control" id="SpecialtyName" name="SpecName">
                    <div class="mb-3">
                        <label for="deptId" class="form-label">Department Name</label>
                        <select
                            class="form-select"
                            name="depId"
                            id="depId"
                            >
                            <option selected>Select one</option>
                            <?php
                            while ($result = $read_result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option value="<?php echo $result["departmentId"];?>"><?php echo $result["departmentName"];?></option>
                            <?php
                            }
                            ?>
                            
                        </select>
                    </div>

                    <div class="mb-3">Description</label>
                        <textarea class="form-control" id="description" rows="2" name="description"></textarea>
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