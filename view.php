<!DOCTYPE html>
<html>
    <head>  
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="header">
    <ul>
  <li><a class="active" href="create.php">Registration Page</a></li>
  <li><a href="view.php">User List </a></li> 
   </ul>
    </div>
 

</body>
</html>
<?php
include "connection.php" ;

     $sql= "SELECT * FROM mydb2.user";
     $result=$conn->query($sql);    
?>
<!DOCTYPE html>
<html>
    <head>       
        <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    </head>
    <body > 
      <div class="container">
            <h2>Users List</h2>
    </form>
            <table class="table">
                <head>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>States</th>
                        <th>Action</th>
                    </tr>
                </thread>   
                <tbody>
                    <?php
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc()){
                        ?>
                         <tr>

                            <td><?php echo $row['id'];?> </td>
                            <td><?php echo $row['firstname'];?> </td>
                            <td><?php echo $row['middlename'];?> </td>
                            <td><?php echo $row['lastname'];?> </td>
                            <td><?php echo $row['mno'];?> </td>
                            <td><?php echo $row['city'];?> </td>
                            <td><?php echo $row['pincode'];?> </td>
                            <td><?php echo $row['state'];?> </td>
                            <td><a class="btn btn-info" href="updates.php?id=<?php echo $row['id']; ?>">
                            Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">
                            Delete</a></td>
                         </tr>
                         <?php }
                                              
                    }
                    ?>

                </tbody>
            </table>
        <div>
    </body>
            
</html>

<?php 
