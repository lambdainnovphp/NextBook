<?php
include('dbconfig.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NextBook</title>  
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    	<section class="loginform cf">

	    	<ul style="list-style:none; text-align:center;">
				<?php
				if($_SESSION['Email']!="")
				{?>
	    		<li>
					<div class="text-center">
						<a href="index.php">Home</a>				
						<a href="#">People</a>
						<a href="Invoice.php">Invoices</a>
						<a href="#">Expenses</a>				
						<a href="logout.php">Sign Out</a>
					</div>
				</li>

				<?php } else {?>

				<li>
					<div class="text-center">
						<a href="index.php">Home</a>				
						<a href="#">People</a>
						<a href="#">Invoices</a>
						<a href="#">Expenses</a>
					</div>
				</li>

				<?php } ?>
			</ul><br><br>