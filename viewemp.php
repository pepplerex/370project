<?php
session_start();
require_once ('process/dbh.php');
$sql = "SELECT * from `employee` , `rank` WHERE employee.id = rank.eid ORDER BY id DESC";

//echo "$sql";
$result = mysqli_query($conn, $sql);

if(isset($_POST['search'])){
	$phold = htmlspecialchars($_POST["search"]);
}else{
	$phold = "";
}
?>
<html>
<head>
	<title>View Employee |  Admin Panel | RH Private Security</title>
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
		.print {
			color: white;
			text-align: center;
			text-color: white;
			padding-left: 50px;
			padding-bottom: 20px;	
		}
		a{
			color: orange;
			text-decoration: none;
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

	
    <?php 
    
        if(isset($_SESSION["result"])){ ?>
            <div id="result"></div>
		<?php  unset($_SESSION["result"]); } ?>

		<?php 
		
		if(isset($_SESSION["err"])){ ?>
			<div id="err"></div>
		<?php  unset($_SESSION["err"]); } ?>



	<div class="container">
		<form method="post">
			<input name="search" type="text" placeholder="Search with ID, email, name & Location" value="<?= $phold;?>">
			<button name="e_search" type="submit">Search</button>
		</form>


       <div class="print">
		 	<a href="#" onclick="window.print();return false;">Click here to print this page</a>
		 
		</div>

	</div>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>

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

		
		<script>

		

		document.addEventListener("DOMContentLoaded",function (){

			let result = document.getElementById("result");

			if(result){
				alert("Succussfully registered new employee");
			}

			let err = document.getElementById("err");

			if(err){
				alert("Failed to registered new employee");
			}

		})

    </script>
	
</body>
</html>
