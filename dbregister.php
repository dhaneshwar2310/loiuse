<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//creating table 
/*
$sql = "CREATE TABLE userinfo (
name VARCHAR(30) NOT NULL,
emailid VARCHAR(30) NOT NULL,
website VARCHAR(50),
comments varchar(200),
gender char(7) 
)";

if ($conn->query($sql) === TRUE) {
  echo "Table userinfo created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}
*/

//get the data from html file
$name=$_POST["name"];
$email=$_POST["email"];
$website=$_POST["website"];
$comments=$_POST["comments"];
$gender=$_POST["gender"];

//insert data into database
$sql = "INSERT INTO userinfo (name, emailid, website,comments,gender)
VALUES ('$name', '$email', '$website','$comments','$gender')";
echo "inserted";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


/*
$sql = 'SELECT name, emailid, comments, gender FROM userinfo';
   mysqli_select_db('$dbname');
   $retval = mysqli_query( $sql, $conn );
   
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
      echo "Name :{$row['name']}  <br> ".
         "Email Id : {$row['emailid']} <br> ".
         "website : {$row['website']} <br> ".
         "comments:{$row['comments']} <br> ".
         "Gender:{$row['gender']} <br>";
   }
   
   echo "Fetched data successfully\n";
   */

   $sql = "select * from userinfo";
   $result = ($conn->query($sql));
   //declare array to store the data of database
   $row = []; 
 
   if ($result->num_rows > 0) 
   {
       // fetch all data from db into array 
       $row = $result->fetch_all(MYSQLI_ASSOC);  
   }   
?>
<html>
<style>
    td,th {
        border: 1px solid black;
        padding: 10px;
        margin: 5px;
        text-align: center;
    }
</style>
  
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Comments</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php
               if(!empty($row))
               foreach($row as $rows)
              { 
            ?>
            <tr>
  
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['emailid']; ?></td>
                <td><?php echo $rows['website']; ?></td>
                <td><?php echo $rows['comments']; ?></td>
                <td><?php echo $rows['gender']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
  
<?php   
    mysqli_close($conn);
   
   //mysql_close($conn);
//$conn->close();
?>