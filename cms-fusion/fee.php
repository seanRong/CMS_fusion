<?php
         if($_POST['submit']) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
            $studentName = $_POST['studentName'];
            $amount = $_POST['amount'];
            $op = $_POST['op'];
            
            
            $sql = "UPDATE wp_wpsp_student". "SET balance = $amount". 
               "WHERE s_fname = $studentName" ;
            mysql_select_db('test_db');
            $retval = mysql_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully\n";
            
            mysql_close($conn);
         }else {
            ?>