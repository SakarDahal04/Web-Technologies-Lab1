<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    // Function to convert newlines to <p> tags
    function nl2p($text)
    {
        // Split the text by newlines
        $paragraphs = explode("\n", $text);

        // Wrap each paragraph in <p> tags
        $paragraphs = array_map(function ($paragraph) {
            return '<p>' . htmlspecialchars($paragraph) . '</p>';
        }, $paragraphs);

        // Join the paragraphs back together
        return implode('', $paragraphs);
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
        <a href="#" class="navbar-brand">Blog Posts</a>

        <!-- For smaller screen show the hamburger menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">Link</a>
                </li>

                <li class="nav-item">
                    <a href="blogform.php" class="nav-link">Add Blog</a>
                </li>
            </ul>
            <form class="my-2 my-lg-0 d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

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

    // Fetch and display blog posts
    $sql = "SELECT id, title, content FROM blogs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title1 = $row["title"];
            $content1 = nl2p($row['content']);
            echo "
                <div class='container mt-5'>
                    <div class='row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-8'>
                            <h1 class='display-5'>" . htmlspecialchars($title1) . "</h1>
                            <div class='lead' style='text-align: justify'>{$content1}</div>
                            <hr>
                        </div>
                        <div class='col-md-2'></div>
                    </div>
                </div>
            ";
        }
    } else {
        echo "<div class='container mt-5'><div class='row'><div class='col-md-2'></div><div class='col-md-8'><p>No blog posts found.</p></div><div class='col-md-2'></div></div></div>";
    }

    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>