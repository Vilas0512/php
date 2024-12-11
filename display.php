<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";     
$dbname = "registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear'])) {
    // Clear all registrations
    $conn->query("DELETE FROM registrations");
    echo "<script>alert('All registrations have been cleared!'); window.location.href='registrations.php';</script>";
}

// Fetch all registrations from the database
$sql = "SELECT id, name, email, age FROM registrations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Registrations</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 900px;
            text-align: center;
        }

        h2 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 26px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #ff7e5f;
            color: white;
        }

        button {
            padding: 16px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Registrations</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['age'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No registrations available.</p>";
        }
        ?>

        <!-- Button to clear all registrations -->
        <form method="POST" action="">
            <button type="submit" name="clear">Clear All Registrations</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
