<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Write Your Blog:</h3>
            </div>
            <div class="col-md-3"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="blogform.php" method="POST">
                    <div class="mb-3">
                        <label for="titleOfBlog" class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleOfBlog" name="titleOfBlog" required>
                    </div>

                    <div class="mb-3">
                        <label for="blogContent" class="form-label">Title</label>
                        <textarea name="blogContent" id="blogContent" class="form-control" rows="3" required></textarea>
                    </div>

                    <input type="submit" class="btn btn-success">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Establishing the database connection
    $servername = "localhost";
    $username = "root";
    $password = "root123";
    $dbname = "testdb1";

    // Create the database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Inserting the data in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["titleOfBlog"];
        $content = $_POST["blogContent"];

        // Preparation of the SQL statement to be executed for inserting the value in the database.
        $stmt = $conn->prepare("INSERT INTO blogs (title, content) VALUES (?, ?)");

        // Connecting the query with the value obtained from the POST request
        $stmt->bind_param("ss", $title, $content);

        // Executing the query
        if ($stmt->execute()) {
            header("Location: index.php");
            // This will redirect the page to the index.php file when user hit the submit button
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>