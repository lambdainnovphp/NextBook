<?php 
include("includes/header.php");
$Usql = "select * from users where email='".$_SESSION['Email']."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));

if($_POST['submit']=="Send Email")
{
	//print_r($_POST); exit;

	$tottaskname = sizeof($_POST['tasksName']);
	for($i=0;$i<$tottaskname;$i++)
	{		
		$SIds = $_POST['tasksName'][$i];
    	$ssd .= $SIds.',';
	}

	//Array ( [ClientName] => test1 [InvoiceNo] => fgdgd [InvoiceDate] => 16-12-2015 [tasksName] => Array ( [0] => dfgdf [1] => sddf [2] => sfdsf ) [taskDesc] => Array ( [0] => gdfg [1] => sdf [2] => dsfdsf ) [taskRate] => Array ( [0] => 43 [1] => 45 [2] => 44 ) [taskHours] => Array ( [0] => 11 [1] => 43 [2] => 34 ) [tasktax1] => Array ( [0] => dfgdf [1] => 43dsff [2] => dffdf ) [tasktax2] => Array ( [0] => gdfgfg [1] => fdsfsd [2] => dfdf ) [tasktotal] => Array ( [0] => 473 [1] => 1935 [2] => 1496 ) [submit] => Send Email )
}

if($_POST['Edsubmit']=="Send Email")
{
	$tottaskname = sizeof($_POST['tasksName']);
	for($i=0;$i<$tottaskname;$i++)
	{		
		$SIds = $_POST['tasksName'][$i];
    	$ssd .= $SIds.',';
	}
}
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

	<?php if($_GET['clicked'] == "Edit"){

		$editInv = mysql_query("Select * from invoice where invoiceId='".$_GET['gets']."'");
		$res_editInv = mysql_fetch_array($editInv);?>

<!-- Edit Invoice Section -->
			<form name="NewInvoice" method="post">
		    	<div id="insertInv" style="width:620px;">		    	
			    	
			    	<div class="left-div">
			    		<table>
			    			<tr>
			    				<td>Client
			    				<select name="ClientName" id="ClientName" style="width:200px;">
                                        <option value=""></option>
                                        <?php 
                                        $Clisql = "select * from client";
                                        $res_Clisql=mysql_query($Clisql);
                                        while($ress = mysql_fetch_array($res_Clisql)){?>
                                            <option value="<?php echo $ress['clientId'];?>"><?php echo $ress['organizationName'];?> (<?php echo $ress['contactName'];?>)</option>
                                        <?php } ?>
                                </select>
                                <script type="text/javascript">
                                for(var i=0;i<document.getElementById('ClientName').length;i++)
                                {
                                	if(document.getElementById('ClientName').options[i].value == "<?php echo $res_editInv['invoiceId'];?>")
                                	{
                                		document.getElementById('ClientName').options[i].selected=true;
                                	}
                                }
                                </script>
                                </td>			
			    			</tr>	
			    			<tr>
                                <td id="showCldata">Address:<?php echo $res_editInv['street1'].','; echo $res_editInv['street2'];?><br><?php echo $res_editInv['city'];?><br><?php echo $res_editInv['state'];?> - <?php echo $res_editInv['zip'];?></td>
                            </tr>		    			
			    		</table>
			    	</div>

			    	<div class="right-div">
                        <table>
                            <tr>
                                <td>Invoice No.</td><td><input type="text" name="InvoiceNo" id="InvoiceNo" value="<?php echo $res_editInv['invoiceNumber'];?>"></td>
                            </tr>
                            <tr>
                                <td>Date</td><td><input type="text" name="InvoiceDate" id="InvoiceDate" value="<?php echo $res_editInv['dateOfIssue'];?>"></td>
                            </tr>                                                        
                        </table>
                    </div>                    
            

		            <div class="rights" style="width:600px;">
	                    <table id="tasks">
	                    	<thead>
	                    		<tr>
	                    			<td colspan="10"><span id="addtaskcol" style="cursor:pointer;">Add Column</span></td>
	                    		</tr>
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
							<?php $editTasksql = mysql_query("select * from invoicetasks where InvoiceId='".$res_editInv['invoiceId']."'");								  
								  while($Task_rows = mysql_fetch_array($editTasksql))
								  	{?>
									<tr>
										<td><input type="text" name="tasksName[]" id="tasksName" value="<?php echo $Task_rows['taskName'];?>"></td>
										<td><input type="text" name="taskDesc[]" id="teskDesc" style="width:100px;" value="<?php echo $Task_rows['Description'];?>"></td>
										<td><input type="text" name="taskRate[]" id="taskRate" value="<?php echo $Task_rows['rate'];?>"></td>
										<td><input type="text" name="taskHours[]" id="taskHours" value="<?php echo $Task_rows['hour'];?>"></td>
										<td><input type="text" name="tasktax1[]" id="tasktax1" value="<?php echo $Task_rows['tax1'];?>"></td>
										<td><input type="text" name="tasktax2[]" id="tasktax2" value="<?php echo $Task_rows['tax2'];?>"></td>
										<td><span id="tasktot"><?php echo $Task_rows['TaskAmount'];?></span><input type="hidden" name="tasktotal[]" id="tasktotal" value="<?php echo $Task_rows['TaskAmount'];?>"></td>
										<td><button type="button" class="removebutton" title="Remove this row">X</button></td>
									</tr>
								<?php } ?>
									<tr>
										<td><input type="text" name="tasksName[]" id="tasksName" value=""></td>
										<td><input type="text" name="taskDesc[]" id="teskDesc" style="width:100px;"></td>
										<td><input type="text" name="taskRate[]" id="taskRate"></td>
										<td><input type="text" name="taskHours[]" id="taskHours"></td>
										<td><input type="text" name="tasktax1[]" id="tasktax1"></td>
										<td><input type="text" name="tasktax2[]" id="tasktax2"></td>
										<td><span id="tasktot">0</span><input type="hidden" name="tasktotal[]" id="tasktotal"></td>
										<td><button type="button" class="removebutton" title="Remove this row">X</button></td>
									</tr>
							</tbody>
	                    </table>

	                    <table>
	                    	<tr>
	                    		<td>
	                    			<span id="addtaskss" style="display:none;cursor:pointer;">Add Task</span>
	                    		</td>
	                    	</tr>
	                    </table>	                    

	                </div>

	                <div style="width:600px;">
	                	<table style="float:right;">
	                		<tr>
	                        	<td style="float:right;"><input type="submit" name="Edsubmit" value="Send Email"> <input type="button" name="cancel" id="cancel" value="Cancel"></td>
	                        </tr>
	                	</table>
	                </div>


	            </div>
			</form>
<!-- End Edit Invoice Section -->



	<?php } else { ?>

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
		        $UserInvoice = "select * from invoice where UserId='".$_SESSION['Userid']."' and status='active'";
		        $Res_UserInv = mysql_query($UserInvoice);
		        $Usno = 1;
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
			            <td><a href="Invoice.php?clicked=Edit&gets=<?php echo $UserInv_row['invoiceId'];?>">Edit</a></td>
			        </tr>
		        <?php } ?>
		    </table> 

		    <form name="NewInvoice" method="post">
		    	<div id="insertInv" style="width:620px;display:none;">		    	
			    	
			    	<div class="left-div">
			    		<table>
			    			<tr>
			    				<td>Client
			    				<select name="ClientName" id="ClientName" style="width:200px;">
                                        <option value=""></option>
                                        <?php 
                                        $Clisql = "select * from client";
                                        $res_Clisql=mysql_query($Clisql);
                                        while($ress = mysql_fetch_array($res_Clisql)){?>
                                            <option value="<?php echo $ress['clientId'];?>"><?php echo $ress['organizationName'];?> (<?php echo $ress['contactName'];?>)</option>
                                        <?php } ?>
                                        <option value="test1">test1</option>
                                    </select>
                                </td>			
			    			</tr>	
			    			<tr>
                                <td id="showCldata"></td>
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
                        </table>
                    </div>                    
            

		            <div class="rights" style="width:600px;">
	                    <table id="tasks">
	                    	<thead>
	                    		<tr>
	                    			<td colspan="10"><span id="addtaskcol" style="cursor:pointer;">Add Column</span></td>
	                    		</tr>
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
									<td><input type="text" name="tasksName[]" id="tasksName"></td>
									<td><input type="text" name="taskDesc[]" id="teskDesc" style="width:100px;"></td>
									<td><input type="text" name="taskRate[]" id="taskRate"></td>
									<td><input type="text" name="taskHours[]" id="taskHours"></td>
									<td><input type="text" name="tasktax1[]" id="tasktax1"></td>
									<td><input type="text" name="tasktax2[]" id="tasktax2"></td>
									<td><span id="tasktot">0</span><input type="hidden" name="tasktotal[]" id="tasktotal"></td>
									<td><button type="button" class="removebutton" title="Remove this row">X</button></td>
								</tr>
							</tbody>
	                    </table>

	                    <table>
	                    	<tr>
	                    		<td>
	                    			<span id="addtaskss" style="display:none;cursor:pointer;">Add Task</span>
	                    		</td>
	                    	</tr>
	                    </table>	                    

	                </div>

	                <div style="width:600px;">
	                	<table style="float:right;">
	                		<tr>
	                        	<td style="float:right;"><input type="submit" name="submit" value="Send Email"> <input type="button" name="cancel" id="cancel" value="Cancel"></td>
	                        </tr>
	                	</table>
	                </div>


	            </div>
			</form>

		<?php } ?>
		    


		    <script type="text/javascript">
		    $(document).ready(function(){

		    	// To Add New Task Column
		    	$('#addtaskcol').click(function(){
	                var tabtex = $('#tasks tr:last').clone();              
	                $('#tasks tr:last').after(tabtex);  
	                $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
	                $('#tasks tr:last').find('#tasktot').html('0');        
	            });

	            // remove last column and task section
	            $(document).on('click','button.removebutton',function(){                            
                    var rowCount = $('#tasks tr').length;   
                    if(rowCount == 3)
                    {   
                        $('#tasks').hide();         
                        $('#addtaskss').show();                 
                    }
                    else
                    {
                        $(this).closest('tr').remove();
                        return false;
                    }                            
                });

                // calculation Part of rate and hours 
                $(document).on('blur','#taskHours',function(){
                	var thour = $(this).val();
                	var trate = $(this).closest('tr').find('input[id="taskRate"]').val();
                	var mult = trate * thour;
                	$(this).closest('tr').find('#tasktot').text(mult);
                	$(this).closest('tr').find('#tasktotal').val(mult);
                });

                $(document).on('blur','#taskRate',function(){
                	var trate = $(this).val();
                	var thour = $(this).closest('tr').find('input[id="taskHours"]').val();
                	var mult = trate * thour;
                	$(this).closest('tr').find('#tasktot').text(mult);
                	$(this).closest('tr').find('#tasktotal').val(mult);
                });

                // Adding Task Section
                $('#addtaskss').click(function(){
                	$(this).hide();
                    $('#tasks').show();
                    $('#addtaskcol').show();
                    $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
                    $('#tasks tr:last').find('#tasktot').html('0');         
                });

                // Add Invoice Section
		    	$('#newInv').click(function(){
		    		$(this).fadeOut('fast');
		    		$('#showInv').fadeOut('slow');
		    		$('#insertInv').slideDown('slow');
		    	});

		    	// close Invoice Section
		    	$('#cancel').click(function(){
		    		$('#newInv').fadeIn('fast');
		    		$('#showInv').fadeIn('fast');
		    		$('#insertInv').slideUp('slow');
		    	});

		    	// Getting client details from database
		    	$("#ClientName").on('change',function(){
		            var CN = $('#ClientName :selected').val();
		            if(CN != "")
		            {
		                $.ajax({
		                    url:"getdata.php",
		                    type:"GET",
		                    data: {"ClientVal": CN,"mode":"Clientdata"},
		                    success:function(dat){
		                        $('#showCldata').html(dat);                        
		                    }
		                });
		            }
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