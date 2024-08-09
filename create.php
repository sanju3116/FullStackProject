<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<ul>
  <li><a class="active" href="create.php">Registration Page</a></li>
  <li><a href="view.php">User List</a></li>
  
</ul>
</html>
<?php
include "connection.php";

// Fetch state data from API
function fetchStates() {
    $url = 'https://quickdesign.dmimpact.com/states';
    $authorization = '123456';
    
    $options = [
        'http' => [
            'header' => "Authorization: $authorization\r\n"
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        die('Error fetching data from API.');
    }
    
    $states = json_decode($response, true);
    
    if ($states === NULL) {
        die('Error decoding JSON response.');
    }

    return $states;
}

$states = fetchStates();
$statesList = $states["stateList"];

if (isset($_POST['submit'])) 
{
    $first_name = trim($_POST['firstname']);
    $middle_name = trim($_POST['middlename']);
    $last_name = trim($_POST['lastname']);
    $mno = trim($_POST['mno']);
    $city = trim($_POST['city']);
    $pincode = trim($_POST['pincode']);
    $state = trim($_POST['state']);

    // Basic validation
    $errors = [];

    // Validate mobile number
    if (empty($mno) || !preg_match('/^\d{10}$/', $mno)) 
    {
        $errors[] = "Mobile number must be exactly 10 digits.";
    }
    else
    {
        // Check if the mobile number already exists
        $stmt = $conn->prepare("SELECT id FROM mydb2.user WHERE mno = ?");
        $stmt->bind_param("s", $mno);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "A record with this mobile number already exists.";
        }
        $stmt->close();
    }

    if ($first_name === $middle_name && $first_name === $last_name && $middle_name === $last_name) {
        $errors[] = "First name, middle name, and last name must be different from each other.";
    }

    // Validate pincode
    if (empty($pincode) || !preg_match('/^\d{6}$/', $pincode)) {
        $errors[] = "Pincode must be exactly 6 digits.";
    }

   

    if (empty($errors)) 
    {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO mydb2.user (firstname, middlename, lastname, mno, city, pincode, state) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $first_name, $middle_name, $last_name, $mno, $city, $pincode, $state);
        $result = $stmt->execute();

        if ($result) {
            header('Location: view.php');
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Display errors
    foreach ($errors as $error) {
        echo '<div class="error">' . htmlspecialchars($error) . '</div>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Registration Form</h2>  
    <form method="post">
    <h3> profile picture </h3>
    <img src="image/profile.jpg" alt="Profile Image" class="profile-picture" style="width:100px;height:100px;">
        <label for="firstname">Enter First Name:</label>
        <input type="text" id="firstname" name="firstname" pattern="[a-zA-Z ]+" title="Please enter only letters" required>
        
        <label for="middlename">Enter Middle Name:</label>
        <input type="text" id="middlename" name="middlename" pattern="[a-zA-Z ]+" title="Please enter only letters" required>
        
        <label for="lastname">Enter Last Name:</label>
        <input type="text" id="lastname" name="lastname" pattern="[a-zA-Z ]+" title="Please enter only letters" required>
        
        <label for="mno">Enter Mobile Number:</label>
        <input type="text" name="mno" id="mno" pattern="\d{10}" title="Enter a 10-digit mobile number" required />
        
        <label for="city">Enter City:</label>
        <input type="text" id="city" name="city" pattern="[a-zA-Z ]+" title="Please enter only letters and spaces" required>
        
        <label for="pincode">Enter Pincode:</label>
        <input type="text" name="pincode" id="pincode" pattern="\d{6}" title="Enter a 6-digit pincode" required />
        
        <label for="state">Select State:</label>
        <select name="state" id="state" required>
            <option value="">Select State</option>
            <?php
            // Debugging: Check if $states array is not empty and contains expected keys
            if (!empty($states)) {
                foreach ($statesList as $state) {
                    if (isset($state['stateCode']) && isset($state['stateName'])) {
                        echo '<option value="' . ($state['stateName']) . '">' .($state['stateName']) . '</option>';
                    } else {
                        echo '<option value="">Invalid state data</option>';
                    }
                }
            } else {
                echo '<option value="">No states available</option>';
            }

            ?>   
        </select>     
           <input type="submit" name="submit" value="SUBMIT" />     
      
    </form>
</body>
</html>

