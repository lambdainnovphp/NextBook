<?php
include('dbconfig.php');

if($_SESSION['Email']=="")
{
	
	if($_POST['submit']=="LogIn Now")
	{
		$sql="select * from users where email='".$_POST['email']."' and password='".$_POST['passWord']."'";
		$squery = mysql_query($sql);
		$loggedvals = mysql_fetch_assoc($squery);
		if(mysql_num_rows($squery)>0)
		{
			$_SESSION['Email']=$_POST['email'];
			$_SESSION['Userid'] = $loggedvals['id'];
			header('location:index.php');
		}
		else
		{
			header('location:index.php');
		}
	}?>
	<div id="container">
        <form name="UserLogin" id="UserLogin" method="post">
			<input type="email" name="email" id="email" placeholder="Enter Email Address" required><br>
			<input type="password" name="passWord" id="passWord" placeholder="Enter Password" required><br>
			<input type="submit" name="submit" value="LogIn Now">
        </form>
	</div>

<?php }else{
	$Usql = "select * from users where email='".$_SESSION['Email']."'";
	$res_Usql=mysql_fetch_assoc(mysql_query($Usql));
	?>
	<div id="container">
        Welcome <?php echo $res_Usql['Firstname'];?>   
        <br><br>
        <table>
        	<tr>
        		<td>Invoices</td>
        		<td>Expenses</td>
        	</tr>
        	<tr align="center">
        		<td>
        		<?php 
        			$InvCount = mysql_query("Select * from invoice where UserId='".$_SESSION['Userid']."'");
        			echo $InvCVals = mysql_num_rows($InvCount);
        			?>
        		</td>
        		<td>
        		<?php 
        			$ExpCount = mysql_query("Select * from expenses where UserId='".$_SESSION['Userid']."'");
        			echo $ExpCVals = mysql_num_rows($ExpCount);        			
        			?>
        		</td>
        	</tr>
        </table> 
	</div>

<?php } ?>

</body>
</html>