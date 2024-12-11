<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
require_once "database.php";

if (isset($_GET["msg"])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Data was successfully Deleted(Operation successfull)
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>


<body>
<div id="alert"></div>
    <div class="container-fluid">
        
        <nav>
            <div class="row p-2">

                <div class="col-3"><a href="./index1.php">Specialty</a></div>
                <div class="col-3"><a href="./index2.php">Department</a></div>
                <div class="col-3"><a href="">Display Specialty</a></div>
                <div class="col-3"><a href="./display2.php">Display Department</a></div>
            </div>
        </nav>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Specialty </th>
                    <th scope="col">Department</th>
                    <th scope="col">Description</th>
                    <th scope="col" colspan="2">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $read_sql = "SELECT specialtyId, departmentName, specialtyName, specialty.description  FROM specialty
                            INNER JOIN department ON department.departmentId = specialty.departmentId
                            WHERE departmentS = 'active' and specialtyS = 'active'";
                $read_result = $handler->prepare($read_sql);
                $read_result->execute();
                $affectedRows = $read_result->rowCount();
                if ($affectedRows > 0) {
                    while ($result = $read_result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <th><?php echo $i; ?></th>
                            <td><?php echo $result["specialtyName"]; ?></td>
                            <td><?php echo $result["departmentName"]; ?></td>
                            <td><?php echo $result["description"]; ?></td>
                            <td>
                                <!-- <button
                                    type="button"
                                    class="btn btn-outline-info" onclick="">
                                    Edit
                                </button> -->
                                <form action="update1.php" method="post">
                                   <input type="submit" class="btn btn-outline-info" value="Edit">
                                    <input type="hidden" name="id" value="<?php echo $result['specialtyId'] ?>">
                                </form>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-danger" onclick="validateDelete(<?php echo $result['specialtyId'] ?>)">
                                    Delete
                                </button>
                            </td>

                        </tr>
                <?php
                        $i += 1;
                    }
                } else {
                    echo "<tr><td colspan ='5' class='text-center'>No data available</td></tr>";
                }
                ?>
            </tbody>

        </table>

    </div>
</body>
<script>
    function validateDelete(id) {
        if (confirm("Are you sure to DELETE????")) {
            $.post("delete1.php", {
                    specialtyId: id
                })
                .done(function(data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a == "success") {
                        window.location.href = "display1.php?msg=success";
                    } 
                    else {
                        document.getElementById("alert").innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Operation Unsuccessful(Could not delete)
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`
                    }

                });
        }

    };
</script>


</html>