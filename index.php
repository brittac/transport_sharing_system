<?php
	$con = mysqli_connect("localhost","root","","project");	
	$errors = array();
	
	// UMID validation
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(strlen($_POST['umid']) < 8 || strlen($_POST['umid']) > 8 ){
			$errors['umid'] = "*  Invalid UMID";
	}
	if(!preg_match('/^[0-9]*$/', $_POST['umid']) ){
		$errors['umid'] = "*  Invalid UMID";
	}

	// First and Last name validation
	if(!preg_match("/^[a-zA-Z]*$/", $_POST['fname'])){
		$errors['fname'] = "*  Invalid First Name.";
	}
	if( strlen($_POST['fname']) === 0){
		$errors['fname'] = "*   Invalid First Name.";
	}
	if(!preg_match("/^[a-zA-Z]*$/", $_POST['lname'])){
		$errors['lname'] = "*   Invalid Last Name.";
	}
	if(strlen($_POST['lname']) === 0){
		$errors['lname'] = "*   Invalid Last Name.";
	}

	// Project title validation
	if(!preg_match("/^[a-zA-Z0-9]*$/", $_POST['project'])){
		$errors['project'] = "*   Invalid Project title.";
	}
	if(strlen($_POST['project']) === 0){
		$errors['project'] = "*   Invalid Project title.";
	}

	// E-mail validation
	if(preg_match("/.+@.+\..+/", $_POST['email']) === 0){
		$errors['email'] = "*  Invalid e-mail address.";
	}
		
	// Phone nuber validation
	if(!preg_match("/^\d{3}-\d{3}-\d{4}$/", $_POST['phone'])){
		$errors['phone'] = "*  Imvalid phone number.";
	}

	// Time Slot validation	
	if(strlen($_POST['time_slot']) === 0){
		$errors['time_slot'] = "* Select a time slot";
	}


	if(count($errors) === 0){
		$umid = mysqli_real_escape_string($con, $_POST['umid']);
		$fname = mysqli_real_escape_string($con, $_POST['fname']);
		$lname = mysqli_real_escape_string($con, $_POST['lname']);
		$project = mysqli_real_escape_string($con, $_POST['project']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$phone = mysqli_real_escape_string($con, $_POST['phone']);
		$time_slot = mysqli_real_escape_string($con, $_POST['time_slot']);	
		
		$search_query = mysqli_query($con, "SELECT * FROM reg WHERE umid = '$umid'");
		$num_row = mysqli_num_rows($search_query);
		if($num_row >= 1){
			echo "<script>alert('You are registered already, Do you wanna change your time?');			
			</script>"; 
			
			echo "<script>alert('Your entry will be deleted. Please fill registration again.');				
			window.location.href='index.php'</script>";

			// sql to delete/update a record
			$del = "DELETE FROM reg WHERE umid = '$umid'";
			
			if (mysqli_query($con, $del)) {
				echo "Record deleted successfully";
			  } else {
				echo "Error deleting record: " . mysqli_error($con);
			  }			
					

		 // Inserting values to the database
		}else{
			$sql = "INSERT INTO reg(`umid`,`fname`, `lname`, `project`, `email`, `phone`, `time_slot`) VALUES ('$umid','$fname', '$lname', '$project', '$email', '$phone', '$time_slot')";
			$query = mysqli_query($con, $sql);
			$_POST['fname'] = '';
			$_POST['lname'] = '';
			$_POST['email'] = '';
			
			$successful = "<h3> You are successfully registered.</h3>";
		}
	}
}

// PhP Code to generate the Empty time slot values for registration /

$slot1 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot1' ");			
$slot1_row = mysqli_fetch_array($slot1);
$empty1 = 6 - $slot1_row[0];	
			
$slot2 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot2' ");			
$slot2_row = mysqli_fetch_array($slot2);
$empty2 = 6 - $slot2_row[0];

$slot3 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot3' ");			
$slot3_row = mysqli_fetch_array($slot3);
$empty3 = 6 - $slot3_row[0];

$slot4 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot4' ");			
$slot4_row = mysqli_fetch_array($slot4);
$empty4 = 6 - $slot4_row[0];

$slot5 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot5' ");			
$slot5_row = mysqli_fetch_array($slot5);
$empty5 = 6 - $slot5_row[0];

$slot6 = mysqli_query($con, "SELECT count(time_slot) FROM reg WHERE time_slot = 'slot6' ");			
$slot6_row = mysqli_fetch_array($slot6);
$empty6 = 6 - $slot6_row[0];

?>

<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/stle.css">
<link rel="stylesheet" href="style1.css">
<title></title>
</head>
<body>
	<div id="container">  
		
		<p>Please Provide information for Sign up</p>
        
        <form method="post" action="index.php">
        	<table>
            	<tr>
                	<td colspan="2"><?php if(isset($successful)){ echo $successful; } ?></td>
                </tr>

				<tr">
                	<td colspan="2"><input type="text" name="umid" id="umid" placeholder="UMID" value="<?php if(isset($_POST['umid'])){echo $_POST['umid'];} ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><?php if(isset($errors['umid'])){echo "<h2>" .$errors['umid']. "</h2>"; } ?></td>
                </tr>

            	<tr>
                	<td><input type="text" name="fname" id="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];} ?>"></td>					                    
                </tr>
				<tr>                	
					<td><?php if(isset($errors['fname'])){echo "<h2>" .$errors['fname']. "</h2>"; } ?></td>                    
                </tr>
                <tr>
					<td><input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];} ?>"></td>                   
                </tr>
				<tr>					
                    <td><?php if(isset($errors['lname'])){echo "<h2>" .$errors['lname']. "</h2>"; } ?></td>
                </tr>
				<tr">
                	<td colspan="2"><input type="text" name="project" id="project" placeholder="Project Title" value="<?php if(isset($_POST['project'])){echo $_POST['project'];} ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><?php if(isset($errors['project'])){echo "<h2>" .$errors['project']. "</h2>"; } ?></td>
                </tr>
                <tr">
                	<td colspan="2"><input type="text" name="email" id="email" placeholder="E-mail Address" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><?php if(isset($errors['email'])){echo "<h2>" .$errors['email']. "</h2>"; } ?></td>
                </tr>

				<tr">
                	<td colspan="2"><input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"></td>
                </tr>
                <tr>
                    <td colspan="2"><?php if(isset($errors['phone'])){echo "<h2>" .$errors['phone']. "</h2>"; } ?></td>
                </tr>							
				              			
            </table>
					

			<h4>Select a time slot</h4>
			<div  class="time_slot">
				
            	<select style="width:320px; height: 110px;" name="time_slot" id="time_slot" size="6" multiple="">
                	<option value="slot1">12/01/21, 6:00 PM – 7:00 PM <?php echo"[ Empty Slot = $empty1 ]"; ?></option>				
                	<option value="slot2">12/02/21, 7:00 PM – 8:00 PM <?php echo"[ Empty Slot = $empty2 ]"; ?></option>
            		<option value="slot3">12/03/21, 8:00 PM – 9:00 PM <?php echo"[ Empty Slot = $empty3 ]"; ?></option>
            		<option value="slot4">12/04/21, 6:00 PM – 7:00 PM <?php echo"[ Empty Slot = $empty4 ]"; ?></option>
            		<option value="slot5">12/05/21, 7:00 PM – 8:00 PM <?php echo"[ Empty Slot = $empty5 ]"; ?></option>
            		<option value="slot6">12/06/21, 8:00 PM – 9:00 PM <?php echo"[ Empty Slot = $empty6 ]"; ?></option>
					<?php if(isset($errors['time_slot'])){echo "<h2>" .$errors['time_slot']. "</h2>"; } ?>
       			</select>
				
    		</div>	
			
			<div>
				<input type="submit" name="submit" id="submit" value="Register">
			</div>
			 

		</form>
       
        
    </div>

	 <!-- Show Data Page -->	
	 <h3>Please click the button to view registerd student list </h3>
	<input type="button" value="Registered List" class="homebutton" id="submit" 
	onClick="document.location.href='data.php'" />
	<br><br><br>

	 <!-- Footer -->
	 <footer>
		<p>&copy; Britta Chowdhury, CIS 525,  UofM Dearborn</p>
    </footer>
</body>
</html>
