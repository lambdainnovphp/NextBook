<?php 
include("includes/header.php");
if($_SESSION['Email']=="")
{
}
?>
	<section class="loginform cf">
		
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

	</section>

<?php } ?>

    </body>
</html>
        