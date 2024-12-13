<!DOCTYPE html>
<html lang="en">
<?php
require_once("header.php");
require_once "database.php";
?>



<body>
    <div class="container-fluid">
        <nav>
            <div class="row p-2">
                <div class="col-3"><a href="./index1.php">Specialty</a></div>
                <div class="col-3"><a href="./index2.php">Department</a></div>
                <div class="col-3"><a href="./display1.php">Display Specialty</a></div>
                <div class="col-3"><a href="">Display Department</a></div>
            </div>
        </nav>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department</th>
                    <th scope="col">Description</th>
                    <th scope="col" colspan="2">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $read_sql = "SELECT departmentId, departmentName, description FROM department WHERE departmentS = 'active' ";
                $result_sql = $handler->prepare($read_sql);
                $result_sql->execute();
                $affectedRows = $result_sql->rowCount();
                if ($affectedRows >0) {
                while ($result = $result_sql->fetch(PDO::FETCH_ASSOC)) {
                // $read_sql = $handler->query("SELECT departmentId departmentName, description FROM department");
                // $read_sql->setFetchMode(PDO::FETCH_ASSOC);
                // $i = 1;
                // while ($result = $read_sql->fetch()) {
                ?>
                    <tr>
                        <th><?php echo $i;?></th>
                        <td><?php echo $result["departmentName"]; ?></td>
                        <td><?php echo $result["description"]; ?></td>
                        <td>
                            <a role="button" href="update2.php?id=<?php echo $result["departmentId"]?>" class="btn btn-outline-info">Edit</a>
                        </td>
                        <td>
                        <a role="button" href="delete2.php?id=<?php echo $result["departmentId"]?>" class="btn btn-danger" onclick="validateDelete()">Delete</a> 
                        </td>
                    </tr>
                <?php
                $i += 1;
                }
            }
            else {
                echo "<tr><td colspan ='4' class='text-center'>No data available</td></tr>";
            }
                ?>
            </tbody>

        </table>
    </div>
</body>

<script>
    function validateDelete() {
        return confirm("Are you sure to DELETE????");
    };
</script>

</html>