<?php

require_once ('process/dbh.php');
$sql = "SELECT * from `employee` , `rank` WHERE employee.id = rank.eid ORDER BY id DESC";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>View Employee |  Admin Panel | XYZ Corporation</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
	<style>
		.container {
			width: 100%;
			height: 8vh;
			padding: 20px 0px 5px;
			background:#060606;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		form{
			background: #fff;
			width: 600px;
			height: 30px;
			display: flex;
		}
		form input {
			flex: 1;
			border: none;
			outline: none;
		}
		form button {
			background: red;
			padding: 10px 50px;
			border: none;
			outline: none;
			color: #fff;
			letter-spacing: 1px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<header>
		<nav>
			<h1>XYZ Corp.</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="container">
		<form method="post">
			<input name="search" type="text" placeholder="Search with ID, email, name & Location" value="<?php echo htmlspecialchars($_POST['search']) ?? "";?>">
			<button name="e_search" type="submit">Search</button>
		</form>

	</div>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<th align = "center">Birthday</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">Location No.</th>
				<th align = "center">Address</th>
				<th align = "center">Location</th>
				<th align = "center">Degree</th>
				<th align = "center">Guarantor_name</th>
				<th align = "center">guarantor_address</th>
				<th align = "center">Guarantor_contact</th>
				<th align = "center">Remarks</th>
				
				
				
				<th align = "center">Options</th>
			</tr>

			<?php 

				function val_input($search){

					$conn = include "process/dbh.php";

					$search = stripcslashes($search);
					$search = trim($search);
					$search = htmlspecialchars($search);
					$search = mysqli_real_escape_string($conn,$search);

					return $search;
					exit;
				}
			
				if(isset($_POST["e_search"])){

					$conn = include "process/dbh.php";

					$search = val_input($_POST["search"]);
					$sql  = "SELECT * FROM employee WHERE id LIKE '%$search%' or firstName LIKE '%$search%' or lastName LIKE '%$search%'
																			or email LIKE '%$search%' or dept LIKE '%$search%'
																			or address LIKE '%$search%' ORDER BY id DESC";


					$query = mysqli_query($conn,$sql);
					if($query){
						if(mysqli_num_rows($query) > 0){

							while ($employee = mysqli_fetch_assoc($query)) {
								echo "<tr>";
								echo "<td>".$employee['id']."</td>";
								echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
								echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
								
								echo "<td>".$employee['email']."</td>";
								echo "<td>".$employee['birthday']."</td>";
								echo "<td>".$employee['gender']."</td>";
								echo "<td>".$employee['contact']."</td>";
								echo "<td>".$employee['nid']."</td>";
								echo "<td>".$employee['address']."</td>";
								echo "<td>".$employee['dept']."</td>";
								echo "<td>".$employee['degree']."</td>";
								echo "<td>".$employee['guarantor_name']."</td>";
								echo "<td>".$employee['guarantor_address']."</td>";
								echo "<td>".$employee['guarantor_contact']."</td>";
								echo "<td>".$employee['remarks']."</td>";
								
			
								echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
			
							}

						}else{ ?>

							<div class="alert">NO DATA FOUND</div>

						<?php }
					}

				}else{

					while ($employee = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>".$employee['id']."</td>";
						echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
						echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
						
						echo "<td>".$employee['email']."</td>";
						echo "<td>".$employee['birthday']."</td>";
						echo "<td>".$employee['gender']."</td>";
						echo "<td>".$employee['contact']."</td>";
						echo "<td>".$employee['nid']."</td>";
						echo "<td>".$employee['address']."</td>";
						echo "<td>".$employee['dept']."</td>";
						echo "<td>".$employee['degree']."</td>";
						echo "<td>".$employee['guarantor_name']."</td>";
						echo "<td>".$employee['guarantor_address']."</td>";
						echo "<td>".$employee['guarantor_contact']."</td>";
						echo "<td>".$employee['remarks']."</td>";
						
	
						echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
	
					}


				}
			
			
			?>
			
			<?php
				
			?>

		</table>
		
	
</body>
</html>
