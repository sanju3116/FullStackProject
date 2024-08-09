<?php 
include "connection.php" ;
if (isset($_GET['id'])) 
{
    $user_id = $_GET['id'];
    $sql = "DELETE FROM mydb2.user WHERE `id`='$user_id'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
</html>
