<?php 
include("includes/header.php");
$Usql = "select * from users where email='".$_SESSION['Email']."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));

if($_POST['submit']=="Send Email")
{
	$tottaskname = sizeof($_POST['tasksName']);
	for($i=0;$i<$tottaskname;$i++)
	{			
    	$InvTaskSql = "insert into invoicetasks(InvoiceId,taskName,Description,rate,hour,tax1,tax2,TaskAmount) values('','".$_POST['tasksName'][$i]."','".$_POST['taskDesc'][$i]."','".$_POST['taskRate'][$i]."','".$_POST['taskHours'][$i]."','".$_POST['tasktax1'][$i]."','".$_POST['tasktax2'][$i]."','".$_POST['tasktotal'][$i]."')";
    	$qq = mysql_query($InvTaskSql);

    	$SIds = mysql_insert_id();
    	$ssd .= $SIds.',';    	    	

    	$tot1 = $_POST['tasktotal'][$i];
		$dfd += $tot1;
	}

	$InvSql = "insert into invoice(UserId,ClientId,invoiceNumber,amount,tasksIds,dateOfIssue,status) values('".$_SESSION['Userid']."','".$_POST['ClientName']."','".$_POST['InvoiceNo']."','".$dfd."','".$ssd."','".$_POST['InvoiceDate']."','active')";
	$resSql = mysql_query($InvSql);

	header('location:invoice.php');
}

if($_POST['Edsubmit']=="Send Email")
{
	$tottaskname = sizeof($_POST['tasksName']);
	for($i=0;$i<$tottaskname;$i++)
	{		
		$SIds = $_POST['tasksName'][$i];
    	$ssd .= $SIds.',';
	}

	print_r($_POST); exit;

	//Array ( [ClientName] => 1 [InvoiceNo] => eeet21 [InvoiceDate] => 2015-12-02 [tasksName] => Array ( [0] => sdad [1] => ) [taskDesc] => Array ( [0] => gdfg [1] => ) [taskRate] => Array ( [0] => 43 [1] => ) [taskHours] => Array ( [0] => 11 [1] => ) [tasktax1] => Array ( [0] => dfgdf [1] => ) [tasktax2] => Array ( [0] => [1] => ) [tasktotal] => Array ( [0] => 473 [1] => ) [Edsubmit] => Send Email )
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

		$editInv = mysql_query("Select * from estimate where estimateId='".$_GET['gets']."'");
		$res_editInv = mysql_fetch_array($editInv);?>

<!-- Edit estimate Section -->
			<form name="Newestimate" method="post">
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
                                        $singleClient = mysql_fetch_assoc($res_Clisql);

                                        $res_Clisql1=mysql_query($Clisql);
                                        while($ress = mysql_fetch_array($res_Clisql1)){?>
                                            <option value="<?php echo $ress['clientId'];?>"><?php echo $ress['organizationName'];?> (<?php echo $ress['contactName'];?>)</option>
                                        <?php } ?>
                                </select>
                                <script type="text/javascript">
                                for(var i=0;i<document.getElementById('ClientName').length;i++)
                                {
                                	if(document.getElementById('ClientName').options[i].value == "<?php echo $res_editInv['ClientId'];?>")
                                	{
                                		document.getElementById('ClientName').options[i].selected=true;
                                	}
                                }
                                </script>
                                </td>			
			    			</tr>	
			    			<tr>
                                <td id="showCldata">Address:<?php echo $singleClient['street1'].','; echo $singleClient['street2'];?><br><?php echo $singleClient['city'];?><br><?php echo $singleClient['state'];?> - <?php echo $singleClient['zip'];?></td>
                            </tr>		    			
			    		</table>
			    	</div>

			    	<div class="right-div">
                        <table>
                            <tr>
                                <td>estimate No.</td><td><input type="text" name="estimateNo" id="estimateNo" value="<?php echo $res_editInv['estimateNumber'];?>"></td>
                            </tr>
                            <tr>
                                <td>Date</td><td><input type="text" name="estimateDate" id="estimateDate" value="<?php echo $res_editInv['dateOfIssue'];?>"></td>
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
							<?php $editTasksql = mysql_query("select * from invoicetasks where InvoiceId='".$res_editInv['estimateId']."'");								  
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

	                    <div align="right" style="margin-right:100px;">
	                    	Total : <span id="Toamount"><?php echo $res_editInv['amount']; ?></span>	                    	
	                    </div>
	                    <input type="text" id="getval" value="<?php echo $res_editInv['amount']; ?>">

	                </div>

	                <div style="width:600px;">
	                	<table style="float:right;">
	                		<tr>
	                        	<td style="float:right;"><input type="submit" name="Edsubmit" value="Send Email"> <input type="button" name="Ecancel" id="Ecancel" onClick="location.href = 'estimate.php'" value="Cancel"></td>
	                        </tr>
	                	</table>
	                </div>


	            </div>
			</form>
<!-- End Edit estimate Section -->



	<?php } else { ?>

		    <button id="newInv" style="float:right;">+ New estimate</button>
		    <table id="showInv">
		        <tr>
		            <td>S.No</td>
		            <td>estimateNo.</td>
		            <td>Client Name</td>
		            <td>Email</td>
		            <td>CreatedOn</td>
		            <td>Total</td>
		            <td>Status</td>
		            <td></td>
		        </tr>
		        <?php
		        $Userestimate = "select * from estimate where UserId='".$_SESSION['Userid']."' and status='active'";
		        $Res_UserInv = mysql_query($Userestimate);
		        $Usno = 1;
		        while($UserInv_row = mysql_fetch_array($Res_UserInv))
		        {
		        ?>
			        <tr>
			            <td><?php echo $Usno++;?></td>
			            <td><?php echo $UserInv_row['estimateNumber'];?></td>
			            <?php $cliendata = mysql_fetch_assoc(mysql_query("select * from client where clientId=".$UserInv_row['ClientId'].""));?>
			            <td><?php echo $cliendata['organizationName'];?></td>
			            <td><?php echo $cliendata['email'];?></td>
			            <td><?php echo $UserInv_row['dateOfIssue'];?></td>
			            <td><?php echo $UserInv_row['amount'];?></td>
			            <td><?php echo $UserInv_row['status'];?></td>
			            <td><a href="estimate.php?clicked=Edit&gets=<?php echo $UserInv_row['estimateId'];?>">Edit</a></td>
			        </tr>
		        <?php } ?>
		    </table> 

		    <form name="Newestimate" method="post">
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
                                <td>estimate No.</td><td><input type="text" name="estimateNo" id="estimateNo" required></td>
                            </tr>
                            <tr>
                                <td>Date</td><td><input type="text" name="estimateDate" id="estimateDate" required></td>
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
									<td>Amount</td>
									<td></td>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td><input type="text" name="tasksName[]" id="tasksName" required></td>
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

	                    <div align="right" style="margin-right:100px;">
	                    	Total : <span id="Toamount">0.00</span>	                    	
	                    </div>

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

			<input type="hidden" id="getval" value="0">

		<?php } ?>
		

		    <script type="text/javascript">
		    $(document).ready(function(){
		    	var sws = 0;

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

                	var ds = $('#getval').val();
                	var sas = $(this).closest('tr').find('#tasktotal').val();  
                	$('#getval').val(sas);  
                	var swa = parseInt(ds) + parseInt(sas);
                	alert(swa);    

                	$('#Toamount').text(swa);   
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

                // Add estimate Section
		    	$('#newInv').click(function(){
		    		$(this).fadeOut('fast');
		    		$('#showInv').fadeOut('slow');
		    		$('#insertInv').slideDown('slow');
		    	});

		    	// close estimate Section
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
			        $( "#estimateDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
			    });  

		    });
		    </script>

		</section>
    </body>
</html>        