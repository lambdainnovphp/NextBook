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
		    <button id="newInv" style="float:right;">+ New Estimate</button>
		    <table id="showInv">
		        <tr>
		            <td>S.No</td>
		            <td>EstimateNo.</td>
		            <td>Client Name</td>
		            <td>Email</td>
		            <td>CreatedOn</td>
		            <td>Total</td>
		            <td>Status</td>
		            <td></td>
		        </tr>
		        <?php
		        $UserEstimate = "select * from estimate where UserId='".$_SESSION['Userid']."'";
		        $Res_UserInv = mysql_query($UserEstimate);
		        $Usno = 0;
		        while($UserInv_row = mysql_fetch_array($Res_UserInv))
		        {
		        ?>
			        <tr>
			            <td><?php echo $Usno++;?></td>
			            <td><?php echo $UserInv_row['estimateNumber'];?></td>
			            <td><?php echo $UserInv_row['organizationName'];?></td>
			            <td><?php echo $UserInv_row['email'];?></td>
			            <td><?php echo $UserInv_row['dateOfIssue'];?></td>
			            <td><?php echo $UserInv_row['amount'];?></td>
			            <td><?php echo $UserInv_row['status'];?></td>
			            <td><a href="">Edit</a></td>
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
                                <td>Estimate No.</td><td><input type="text" name="EstimateNo" id="EstimateNo" required></td>
                            </tr>
                            <tr>
                                <td>Date</td><td><input type="text" name="EstimateDate" id="EstimateDate" required></td>
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

                // Add Estimate Section
		    	$('#newInv').click(function(){
		    		$(this).fadeOut('fast');
		    		$('#showInv').fadeOut('slow');
		    		$('#insertInv').slideDown('slow');
		    	});

		    	// close Estimate Section
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
			        $( "#EstimateDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
			    });  

		    });
		    </script>

		</section>
    </body>
</html>        