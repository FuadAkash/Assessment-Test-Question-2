<?php

    $dbHost = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "car_inventory";

    $conn = new mysqli($dbHost, $user, $pass, $dbname);//database conection

    if (isset($_POST['submit'])) {
        // Get form input values
        $CarType = $_POST['carType'];
        $CarName = $_POST['carName'];
        $CarModel = $_POST['carModel'];
        $ReleaseYear = $_POST['releaseYear'];
        $batteryCapacity = $_POST['batteryCapacity'];
        $fuelEfficiency = $_POST['fuelEfficiency'];
        $img = $_FILES['carImage'];
        $iName = $img['name'];
        $tempName = $img['tmp_name'];

        $format = explode('.', $iName);
        $actualName = strtolower($format[0]);
        $actualFormat = strtolower($format[1]);
        $allowedFormats = ['jpg', 'png', 'jpeg', 'gif'];

        if (in_array($actualFormat, $allowedFormats)) {
            $file = 'Uploads/' . $actualName . '.' . $actualFormat;
            $sql = "INSERT INTO carinfo(carType, carName, carModel, releaseYear, batteryCapacity, fuelEfficiency, carImage) VALUES ('$CarType', '$CarName', '$CarModel', '$ReleaseYear', '$batteryCapacity','$fuelEfficiency', '$file')";
            if ($conn->query($sql) === true) {
                move_uploaded_file($tempName, $file);
                echo "<div class='alert alert-success'>Data inserted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Invalid file format</div>";
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    $sql = "SELECT carType, carName, carModel, releaseYear, batteryCapacity, fuelEfficiency, carImage FROM carinfo";

    $result = mysqli_query($conn, $sql);

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Car Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <div class="container form-container">
            <h2 class="mb-4">Add Car</h2>
            <form action="addCar.php" method="post" enctype="multipart/form-data">
                <!-- Car Type -->
                <div class="form-group">
                    <label for="carType">Car Type:</label>
                    <select class="form-control" id="carType" name="carType" required>
                        <option value="ElectricCar">Electric Car</option>
                        <option value="GasCar">Gas Car</option>
                    </select>
                </div>

                <!-- Car Name -->
                <div class="form-group">
                    <label for="carName">Car Name:</label>
                    <input type="text" class="form-control" id="carName" name="carName" required>
                </div>

                <!-- Car Model -->
                <div class="form-group">
                    <label for="carModel">Car Model:</label>
                    <input type="text" class="form-control" id="carModel" name="carModel" required>
                </div>

                <!-- Release Year -->
                <div class="form-group">
                    <label for="releaseYear">Release Year:</label>
                    <input type="text" class="form-control" id="releaseYear" name="releaseYear" required>
                </div>

                <!-- Mileage of Car Type -->
                <div id="electricFields" style="display:none;">
                    <div class="form-group">
                        <label for="batteryCapacity">Battery Capacity(KWh):</label>
                        <input type="text" class="form-control" id="batteryCapacity" name="batteryCapacity">
                    </div>
                </div>

                <div id="gasFields" style="display:none;">
                    <div class="form-group">
                        <label for="fuelEfficiency">Fuel Efficiency(MPG):</label>
                        <input type="text" class="form-control" id="fuelEfficiency" name="fuelEfficiency">
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label for="carImage">Car Image:</label>
                    <input type="file" class="form-control-file" id="carImage" name="carImage">
                </div>

                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                </div>

            </form>
        </div>

        <!-- Car data from database -->
        <div class="container text-center">
            <h2 class="mb-4">Cars</h2>
        </div>
        <table>
            <thead>
            <tr>
                <th>Car Type</th>
                <th>Car Name</th>
                <th>Car Model</th>
                <th>Release Year</th>
                <th>Mileage(KWh/MPG)</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["carType"] . "</td>";
                    echo "<td>" . $row["carName"] . "</td>";
                    echo "<td>" . $row["carModel"] . "</td>";
                    echo "<td>" . $row["releaseYear"] . "</td>";

                    if ($row["carType"] == "ElectricCar") {
                        echo "<td>" . $row["batteryCapacity"] . "</td>";
                    } elseif ($row["carType"] == "GasCar") {
                        echo "<td>" . $row["fuelEfficiency"] . "</td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "<td><img src='" . $row["carImage"] . "' style='max-width: 100px; max-height: 100px;'></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>

            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- To select the fuel type-->
        <script>
            function updateAdditionalFields() {
                var electricFields = document.getElementById('electricFields');
                var gasFields = document.getElementById('gasFields');
                var carType = document.getElementById('carType');

                if (carType.value === 'ElectricCar') {
                    electricFields.style.display = 'block';
                    gasFields.style.display = 'none';
                } else if (carType.value === 'GasCar') {
                    gasFields.style.display = 'block';
                    electricFields.style.display = 'none';
                } else {
                    electricFields.style.display = 'none';
                    gasFields.style.display = 'none';
                }
            }
            document.getElementById('carType').addEventListener('change', updateAdditionalFields);
            document.addEventListener('DOMContentLoaded', updateAdditionalFields);
        </script>

    </body>
</html>