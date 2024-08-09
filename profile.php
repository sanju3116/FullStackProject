<?php
error_reporting(E_ALL); // Show all errors for debugging

$msg = "";

// Database connection
$db = mysqli_connect("localhost", "root", "", "mydb2", 3306);

if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;

    // Move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        $sql = "INSERT INTO image (filename) VALUES (?)";
        $stmt = mysqli_prepare($db, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $filename);
            if (mysqli_stmt_execute($stmt)) {
                $msg = "Image uploaded successfully!";
            } else {
                $msg = "Failed to save image info in database: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $msg = "Failed to prepare statement: " . mysqli_error($db);
        }
    } else {
        $msg = "Failed to upload image!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <div id="content" class="container mt-4">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" required />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
            <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
        </form>
    </div>
    <div id="display-image" class="container mt-4">
        <?php
        $query = "SELECT * FROM image";
        $result = mysqli_query($db, $query);

        if (!$result) {
            echo "<p>Error retrieving images: " . mysqli_error($db) . "</p>";
        } elseif (mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                echo '<img src="./image/' . htmlspecialchars($data['filename']) . '" alt="Uploaded Image" style="max-width: 10%; height: auto; margin-bottom: 50px;">';
            }
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</body>

</html>
