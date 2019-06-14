<?php
/**
* Plugin Name: CMS Fusion
* Plugin URI: TBD.com
* Description: Fee tracker add-on to WPSP for Pansophy
* Version: 1.0
* Author: Sean Rong
* Author URI: github.com/seanRong
**/

add_action('admin_menu', 'addMenu');
function addMenu(){
	add_menu_page('Fusion Dashboard', 'Fusion Dashboard', 4, 'fusion-dashboard', 'fusionMenu');
}

function fusionMenu(){
	echo "Operation panel for student fees! <br>
	Initialization button: turn all NULL cell -> 0
	<form action='' onsubmit='' method='post' target='bait'>
	<input class='submit' type='submit' value='Initialize' name='init'>
	</form>
	<br>
<br>
    Name
    <form action='' onsubmit='' method='post' target='bait'>

    
		<div>
            
            <input type='string' id='studentName' name='studentName'>
            
        </div>
        

    Amount

    
	<div>
		
		<input type='number' name='amount' id='amount'>
		
	</div>
	


Add/Subtract

    
<div>
<input type='radio' name='op' id='op' value='add' checked> Add<br>
<input type='radio' name='op' id='op' value='subtract'> Subtract<br>
	
</div>





<input class='submit' type='submit' value='Submit' name='change'>


</form>



<iframe name='bait' style='display:none;'></iframe>

";
}

if ($_POST['init']) {

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

	$sql = "UPDATE wp_wpsp_student SET balance = '0' WHERE balance IS NULL ";


	if (mysqli_query($conn, $sql)) {
		echo '<script language="javascript">';
		echo 'alert("Record init success")';
		echo '</script>';
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}




}

if ($_POST['change']) {

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

	$prev_amount = "SELECT balance FROM wp_wpsp_student WHERE s_fname='$studentName'";
	$new_amount = "$prev_amount + $op";
	
	$sql = "UPDATE wp_wpsp_student SET balance='$new_amount' WHERE s_fname='$studentName'";

if (mysqli_query($conn, $sql)) {
	echo '<script language="javascript">';
	echo 'alert("Update Success")';
	echo '</script>';
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
	

	}

	

?>