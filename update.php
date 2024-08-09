<?php  
include "connection.php" ;

if(isset($_POST['update']))
{
    $first_name=$_POST['firstname'];
    $age=$_POST['age'];

   
    $sql = "UPDATE mydb.users SET firstname='$first_name', age='$age' WHERE id='$user_id'";

    $result=$conn->query($sql);   
    if($result == TRUE)
    {
        echo"New record updated";
    }
    else
    {
        echo"error:". $sql ."<br>".$conn->error;
    }

    
      if(isset($_GET['id']))
      {
        $user_id = $_GET['id'];
        $sql= "SELECT * FROM mydb.users WHERE 'id='$user_id''";
        $result=$conn->query($sql);   

        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                $first_name=$row['firstname'];
                $age=$row['age'];
                $id=$row['id'];
            }
            ?>
             <h2>User Update Form</h2>
             <h2> Updated page </h2>
             <form  method="post">          
                 Enter first name: <input type="text" name="firstname" value="<?php echo $first_name; ?>">  
                <input type=hidden name="user_id" value="<?php echo $id; ?>">
                Enter age: <input type="number" name="age" value="<?php echo $age; ?>"><br><br>
               <input type="submit" name="update" value="UPDATE"/>  
           </form>     
         </body>
           </html>
         <?php    
       }
        else 
        {
                header('Location: view.php');
        }
   } 
}
?>