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

    	<ul style="list-style:none; text-align:center;padding:50px 0px 0px 0px;margin:0px 0px -45px -228px;">
			<li>
				<div class="text-center">
					<a href="index.php">Home</a>				
					<a href="">People</a>
					<a href="Invoice.php">Invoices</a>
					<a href="">Expenses</a>
				<?php
				if($_SESSION['Email']!="")
				{?>
					<a href="logout.php">Sign Out</a>
				<?php } ?>
				</div>
			</li>
		</ul>