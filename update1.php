<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
require_once "database.php";
$id = $_POST["id"];
    $read_sql = "SELECT departmentName,specialty.departmentId, specialtyName, specialty.description  FROM specialty
                            INNER JOIN department ON department.departmentId = specialty.departmentId
                            WHERE departmentS = 'active' and specialtyS = 'active' and specialtyId=?";
$read_result = $handler->prepare($read_sql);
$read_result->execute(array($id));
$result = $read_result->fetch(PDO::FETCH_ASSOC);

$read_sql2 = "SELECT departmentId, departmentName FROM department WHERE departmentS = 'active' ";
$read_result2 = $handler->prepare($read_sql2);
$read_result2->execute();

if (isset($_POST["submit"])) {
    $a = print_r($_POST);
    echo "<script>alert('{$a}')</script>";
    $specName = $_POST["specName"];
    $depId = $_POST["depId"];
    $description = $_POST["description"];
    $id = $_POST["id"];
    $update_sql = "UPDATE specialty SET specialtyName =?, departmentId = ?, description = ? WHERE specialtyId = ?";
    $update_result = $handler->prepare($update_sql);
    $update_result->execute(array($specName, $depId, $description, $id));
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
        <h3>Edit Specialty Data</h3>
        <div class="">
            <div class="mb-3">
                <form action="" method="post">
                    <label for="SpecialtyName" class="form-label">Specailty Name</label>
                    <input type="text" class="form-control" id="SpecialtyName" name="specName" value="<?php echo $result["specialtyName"]; ?>">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <div class="mb-3">
                        <label for="deptId" class="form-label">Department Name</label>
                        <select
                            class="form-select"
                            name="depId"
                            id="depId">
                            <?php
                            while ($result2 = $read_result2->fetch(PDO::FETCH_ASSOC)) {
                                if ($result2["departmentId"] == $result["departmentId"]) {
                            ?>
                                    <option value="<?php echo $result2["departmentId"]; ?>" selected><?php echo $result2["departmentName"]; ?></option>

                                <?php
                                }else{
                                ?>
                                <option value="<?php echo $result2["departmentId"]; ?>"><?php echo $result2["departmentName"]; ?></option>
                            <?php
                            }
                        }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">Description</label>
                        <textarea class="form-control" id="description" rows="2" name="description"><?php echo $result["description"] ?></textarea>
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