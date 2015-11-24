<?php 
include("includes/header.php");
$Usql = "select * from users where email='".$_SESSION['Email']."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));
?>
		<section class="loginform cf">
			
		    Welcome <?php echo $res_Usql['Firstname'];?>
		    <br><br>
		    <table>
		        <tr>
		            <td>S.No</td>
		            <td></td>
		        </tr>
		        <tr>
		            <td></td>
		            <td></td>
		        </tr>
		    </table> 

		</section>

    </body>
</html>        