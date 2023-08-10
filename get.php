<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "esp";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is OK<br>";

if (isset($_POST["temperature"]) && isset($_POST["humidity"])) {

    $t = $_POST["temperature"];
    $h = $_POST["humidity"];

    $sql = "INSERT INTO th (temperature, humidity) VALUES (" . $t . ", " . $h . ")";

    if (mysqli_query($conn, $sql)) {
        echo "\nNew record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
$query = "SELECT temperature, humidity FROM th";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $temperature = $row["temperature"];

    $humidity = $row["humidity"];

    echo "Temperature: " . $temperature . "°C<br>";
    echo "Humidity: " . $humidity . "%";
} else {
    echo "No results found";
}

$conn->close();
?>