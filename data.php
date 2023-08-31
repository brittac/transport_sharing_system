
	<?php
	$con = mysqli_connect("localhost","root","","project");
	$result = mysqli_query($con,"SELECT * FROM reg");
	?>
    <!DOCTYPE html>
 <html>
 <head>
 <title> Show Data</title>
 <link type="text/css" rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="style1.css">
 </head>
<body>
	 
    <style>
		body {
		font-family:   Verdana, Geneva, Tahoma, sans-serif;  
		font-size: 100%;
		width: 70%;          /* changed from 960 pixels */               
		max-width: 1024px;                  
		 
		margin: 10px auto;
		padding: 16px 0;
		
		}

        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width:80%;
		max-width:1024px ;
		background-color: bisque;  
    	}

    	td, th {
         border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;

    	}

    	tr:nth-child(even) {
        background-color: white;
   		}
    </style>

    <h3>List of all the students who have registered</h3>

	<?php if (mysqli_num_rows($result) > 0) { ?>
	<table id="showData">  
  	<tr>
	    <td style="font-weight: bold;">UMID</td>     	
    	<td style="font-weight: bold;">First Name</td>
    	<td style="font-weight: bold;">Last Name</td> 
		<td style="font-weight: bold;">Project Title</td>   
    	<td style="font-weight: bold;">Email</td>
		<td style="font-weight: bold;">Phone</td>
		<td style="font-weight: bold;">Time Slot</td>
  	</tr>
	<?php
	$i=0;
	while($row = mysqli_fetch_array($result)) {
	?>
	<tr>
    	<td><?php echo $row["umid"]; ?></td>    	
		<td><?php echo $row["fname"]; ?></td>
    	<td><?php echo $row["lname"]; ?></td> 
		<td><?php echo $row["project"]; ?></td>    
    	<td><?php echo $row["email"]; ?></td>   
    	<td><?php echo $row["phone"]; ?></td>
		<td><?php echo $row["time_slot"]; ?></td>
	</tr>
	<?php $i++; } ?>
	</table>
	 <?php 	}else{  echo "No result found";	}?>

	 
	 <!-- Footer -->
	 <footer>
		<p>&copy; Britta Chowdhury, CIS 525,  UofM Dearborn</p>
    </footer>	

</body>
</html>
