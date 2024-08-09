
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

if (isset($_POST['update'])) 
{
    // Retrieve and sanitize the input data
    $first_name = trim($_POST['firstname']);
    $middle_name = trim($_POST['middlename']);
    $last_name = trim($_POST['lastname']);
    $user_id = $_POST['id'];
    $mno = trim($_POST['mno']);
    $city = trim($_POST['city']);
    $pincode = trim($_POST['pincode']);
    $state = trim($_POST['state']);


    // Basic validation
    $errors = [];
    

// Check if all names are different
if ($first_name === $middle_name ||$first_name === $last_name || $middle_name === $last_name) {
    $errors[] = "First name, middle name, and last name must be different from each other.";
}

    // Validate mobile number
    if (empty($mno) || !preg_match('/^\d{10}$/', $mno)) {
        $errors[] = "Mobile number must be exactly 10 digits.";
    }
    
    // Validate city
    if (empty($city)) {
        $errors[] = "City is required.";
    }

    // Validate pincode
    if (empty($pincode) || !preg_match('/^\d{6}$/', $pincode)) {
        $errors[] = "Pincode must be exactly 6 digits.";
    }

    if (empty($errors)) 
    {
    $sql = "UPDATE mydb2.user SET firstname='$first_name', middlename='$middle_name', lastname='$last_name',mno='$mno',city='$city',pincode='$pincode' WHERE id='$user_id'";  
       if ($firstname === $middle_name ||$first_name === $last_name || $middle_name === $last_name) 
       {
        $errors[] = "First name, middle name, and last name must be different from each other.";
       }
        $result=$conn->query($sql);  
        if($result == TRUE)
        {
        echo "Record updated successfully.";
         header('Location: view.php');  
        exit();
        }
    
    else
    {
        echo"error:". $sql ."<br>".$conn->error;
    }
 }
}
if (isset($_GET['id'])) 
{
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM mydb2.user WHERE `id`='$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $first_name = $row['firstname'];
            $middle_name = $row['middlename'];
            $last_name = $row['lastname'];
            $mno = $row['mno'];
            $city = $row['city'];
            $pincode = $row['pincode'];
            $state = $row['state'];
            $id = $row['id'];
        }     
        ?> 
        <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <h2>User Update Form</h2>
        <form method="post">
                <label for="firstname">Enter First Name:</label>
                <input type="text" name="firstname"  pattern="[a-zA-Z ]+" title="Please enter only letters"value="<?php echo $first_name; ?>"required> 
                <input type="hidden" name="id" value="<?php echo $id; ?>"> <br> 

                <label for="middlename">Enter Middle Name:</label>
                <input type="text" name="middlename"  pattern="[a-zA-Z ]+" title="Please enter only letters" value="<?php echo $middle_name; ?>"required> <br>  

                <label for="lastname">Enter Last Name:</label>
                <input type="text" name="lastname"  pattern="[a-zA-Z ]+" title="Please enter only letters" value="<?php echo $last_name; ?>"required>  <br> 

                <label for="mno">Enter Mobile Number:</label>
                <input type="text" name="mno" id="mno" pattern="\d{10}" title="Enter a 10-digit mobile number"value="<?php echo $mno; ?>" required />

                <label for="city">Enter City:</label>
                <input type="text" name="city" pattern="[a-zA-Z ]+" title="Please enter only letters"value="<?php echo $city; ?>"required> <br> 

                <label for="pincode">Enter Pincode:</label>
                <input type="text" name="pincode" id="pincode" pattern="\d{6}" title="Enter a 6-digit pincode" value="<?php echo $pincode; ?>"required> <br>
        
                <label for="state">Select State:</label>
                <select name="state" id="state" value="<?php echo $state;?>"required>
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
        </select>   <br><br>            
                <input type="submit" name="update" value="UPDATE"/> 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
        </form>
        </body>

        </html> <?php    }
        else 
        {
                header('Location: view.php');
                exit();
     }
} 
?>
