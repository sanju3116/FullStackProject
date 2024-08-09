<?php
error_reporting(E_ALL); // Enable error reporting for debugging

// Database connection
$db = mysqli_connect("localhost", "root", "", "mydb",3309);

// Check for connection errors
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the upload button is clicked
if (isset($_POST['upload'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    

    // Sanitize filename for security
    $filename = mysqli_real_escape_string($db, $filename);

    // Insert filename into the database
    $sql = "INSERT INTO profiles (filename) VALUES ('$filename')";

    // Execute query and check for errors
    if (mysqli_query($db, $sql)) {
        // Move the uploaded image to the folder
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>Image uploaded successfully!</h3>";
        } else {
            echo "<h3>Failed to upload image!</h3>";
        }
    } else {
        echo "<h3>Error: " . mysqli_error($db) . "</h3>";
    }
}

// Query to retrieve images from the database
$sql = "SELECT * FROM profiles";
$result = mysqli_query($db, $sql); // Ensure $sql is defined before this line

if (!$result) {
    die("Query failed: " . mysqli_error($db));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div id="content" class="container mt-5">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" required />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
        <!-- Display upload status -->
    </div>
    <div id="display-image" class="container mt-5">
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
            echo '<img src="./image/' . htmlspecialchars($data['filename']) . '" alt="Image" style="max-width: 200px; margin: 10px;">';
        }
        ?>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($db);
?>
