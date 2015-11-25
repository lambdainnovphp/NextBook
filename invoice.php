<?php 
include("includes/header.php");
$Usql = "select * from users where email='".$_SESSION['Email']."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));
?>

<style type="text/css">
.left-div
{
    width:300px;
    float: left;
}
.right-div
{
    width: 300px;    
    float: right;
}
.rights input{
	width:50px;
}
</style>
	
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script> 
	<!-- Jquery Date Picker -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!-- End Jquery Date Picker -->

					
		    Welcome <?php echo $res_Usql['Firstname'];?>
		    <br><br>
		    <button id="newInv" style="float:right;">+ New Invoice</button>
		    <table id="showInv">
		        <tr>
		            <td>S.No</td>
		            <td>InvoiceNo.</td>
		            <td>Client Name</td>
		            <td>Email</td>
		            <td>CreatedOn</td>
		            <td>Total</td>
		            <td>Status</td>
		            <td></td>
		        </tr>
		        <?php
		        $UserInvoice = "select * from invoice where UserId='".$_SESSION['Userid']."'";
		        $Res_UserInv = mysql_query($UserInvoice);
		        $Usno = 0;
		        while($UserInv_row = mysql_fetch_array($Res_UserInv))
		        {
		        ?>
			        <tr>
			            <td><?php echo $Usno++;?></td>
			            <td><?php echo $UserInv_row['invoiceNumber'];?></td>
			            <td><?php echo $UserInv_row['organizationName'];?></td>
			            <td><?php echo $UserInv_row['email'];?></td>
			            <td><?php echo $UserInv_row['dateOfIssue'];?></td>
			            <td><?php echo $UserInv_row['amount'];?></td>
			            <td><?php echo $UserInv_row['status'];?></td>
			            <td><a href="">Edit</a></td>
			        </tr>
		        <?php } ?>
		    </table> 

		    <form name="NewInvoice" method="post">
		    	<div id="insertInv" style="width:620px;">		    	
			    	
			    	<div class="left-div">
			    		<table>
			    			<tr>
			    				<td>Client</td>
			    				<td><input type="text" name="ClName" id="ClName" required></td>			
			    			</tr>			    			
			    		</table>
			    	</div>

			    	<div class="right-div">
                        <table>
                            <tr>
                                <td>Invoice No.</td><td><input type="text" name="InvoiceNo" id="InvoiceNo" required></td>
                            </tr>
                            <tr>
                                <td>Date</td><td><input type="text" name="InvoiceDate" id="InvoiceDate" required></td>
                            </tr>                            
                            <tr>
                            	<td></td><td><input type="submit" name="submit" value="Send Email"> <input type="button" name="cancel" id="cancel" value="Cancel"></td>
                            </tr>
                        </table>
                    </div>

	            </div>
	            

	            <div class="rights" style="width:600px;">
                	<span id="adding">add Another Task</span>
                    <table>
                    	<thead>
							<tr>
								<td>Task</td>
								<td>Description</td>
								<td>Rate</td>
								<td>Hours</td>
								<td>Tax</td>
								<td>Tax</td>
								<td>Total</td>
								<td></td>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><input type="text" name="tasksdet[]" id="tasksdet"></td>
								<td><input type="text" name="taskDesc[]" id="teskDesc" style="width:100px;"></td>
								<td><input type="text" name="taskRate[]" id="taskRate"></td>
								<td><input type="text" name="taskHours[]" id="taskHours"></td>
								<td><input type="text" name="tasktax1[]" id="tasktax1"></td>
								<td><input type="text" name="tasktax2[]" id="tasktax2"></td>
								<td><input type="text" name="tasktotal[]" id="tasktotal"></td>
								<td><button type="button" class="removebutton" title="Remove this row">X</button></td>
							</tr>
						</tbody>
                    </table>

                </div>
			</form>
		    


		    <script type="text/javascript">
		    $(document).ready(function(){
		    	$('#newInv').click(function(){
		    		$(this).fadeOut('fast');
		    		$('#showInv').fadeOut('slow');
		    		$('#insertInv').slideDown('slow');
		    	});

		    	$('#cancel').click(function(){
		    		$('#newInv').fadeIn('fast');
		    		$('#showInv').fadeIn('fast');
		    		$('#insertInv').slideUp('slow');
		    	});

		    	// Date picker
		    	$(function() {
			        $( "#InvoiceDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
			    });  

		    });
		    </script>








		</section>
    </body>
</html>        