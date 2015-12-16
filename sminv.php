<?php
error_reporting(0);
include("includes/dbconfig.php");
if($_POST['invoice_btn']=="Save Email")
{
	//print_r($_POST); exit;	
	$tottaskname = sizeof($_POST['data']['Invoice']['itemNo']); 
	for($i=0;$i<$tottaskname;$i++)
	{			
    	$InvTaskSql = "insert into invoicetasks(InvoiceId,taskName,Description,rate,hour,tax1,tax2,TaskAmount) values('','".$_POST['data']['Invoice']['itemName'][$i]."','".$_POST['data']['Invoice']['itemDesc'][$i]."','".$_POST['data']['Invoice']['price'][$i]."','".$_POST['data']['Invoice']['quantity'][$i]."','','','".$_POST['data']['Invoice']['total'][$i]."')";
    	$qq = mysql_query($InvTaskSql);

    	$SIds = mysql_insert_id();
    	$ssd .= $SIds.',';    	    	
     	//$tot1 = $_POST['tasktotal'][$i];
		// $dfd += $tot1;
	}	

	$InvSql = "insert into invoice(UserId,ClientId,invoiceNumber,amount,tasksIds,dateOfIssue,status) values('".$_SESSION['Userid']."','".$_POST['data']['clientCompanyName']."','".$_POST['InvoiceNo']."','".$_POST['data']['subTotal']."','".$ssd."','".$_POST['InvoiceDate']."','active')";
	$resSql = mysql_query($InvSql);

	header('location:invoice.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Invoice</title>
    <!-- Bootstrap -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,200' rel='stylesheet' type='text/css'>
    <link href="http://demo.smarttutorials.net/invoice-script-php/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://demo.smarttutorials.net/invoice-script-php/css/admin.css" rel="stylesheet">
    
  	<!-- Script -->
    <script src="http://demo.smarttutorials.net/invoice-script-php/js/jquery.min.js"></script>
   
    <script>
		// $(document).ready(function() {
		// 	jQuery('.load-animate').waypoint({
		// 		triggerOnce: true,
		// 		offset: '80%',
		// 		handler: function() {
		// 			jQuery(this).addClass('animated fadeInUp');
		// 		}
		// 	});
		// });
	</script>
  </head>
 <body>
    
	<link href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.min.css" rel="stylesheet">
	<link href="http://demo.smarttutorials.net/invoice-script-php/css/datepicker.css" rel="stylesheet">    

    <!-- Begin page content -->
    <div class="container content-invoice">
    	<form id="invoice-form" method="post"  class="invoice-form" role="form" novalidate> 
	    	<div class="sload-animate">
		    	<input type="hidden" value="" name="data[id]">
		    	
		    	<div class='row'>
		    		<div class='col-xs-8 col-sm-8 col-md-8 col-lg-8'>
		    			<h1 class="title">New Invoice</h1>
		    		</div>
		    		
		    		<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
		    			<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Send Email" class="btn btn-success submit_btn invoice-save-top form-control"/>
		    		</div>
		    	</div>
		      	<input id="currency" type="hidden" value="$">
		    	<div class='row'>
		      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
		      			<h3>From,</h3>		      			
		      				<!-- <img style="height: 65px;" src="img/logo.png"> -->
		      					<br/>
		      				testing<br/>
		      				testingggg
		      				tejasdgasj , sjdgsdsds, 
		      				dmhdsd - 352474 <br/>
		      				sdifhsdkfjsdf<br>
		      				dkfuafkadfh
		      		</div>		      			      		
		      		
		      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4 '>
		      			<h3>To,</h3>
		      			<div class="form-group">
							<input value=""  type="text" class="form-control" name="data[clientCompanyName]" id="clientCompanyName" placeholder="Company Name">
						</div>
						<div class="form-group">
							<textarea class="form-control txt" rows='3' name="data[clientAddress]" id="clientAddress" placeholder="Your Address"></textarea>
						</div>
						
		      		</div>
		      	</div>
		      	<div class='row'>
		      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		      			<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
									<th width="10%">Item No</th>
									<th width="15%">Item Name</th>
									<th width="30%">Item Description</th>
									<th width="15%">Price</th>
									<th width="15%">Quantity</th>
									<th width="15%">Total</th>
								</tr>
							</thead>
							<tbody>
																	<tr>
										<td><input class="case" type="checkbox"/></td>
										<td><input type="text" data-type="productCode" name="data[Invoice][itemNo][]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
										<td><input type="text" data-type="productName" name="data[Invoice][itemName][]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
										<td><input type="text" data-type="productDesc" name="data[Invoice][itemDesc][]" id="itemDesc_1" class="form-control"></td>
										<td><input type="number" name="data[Invoice][price][]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
										<td><input type="number" name="data[Invoice][quantity][]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
										<td><input type="number" name="data[Invoice][total][]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
									</tr>
															</tbody>
						</table>
		      		</div>
		      	</div>		      	
		      	<div class='row'>
		      		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
		      			<button class="btn btn-danger delete" type="button">- Delete</button>
		      			<button class="btn btn-success addmore" type="button">+ Add More</button>
		      		</div>
		      	</div>
		      	<div class='row'>	
		      		<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		      			<h4>Date : </h4>
		      			<div class="form-group">
		      				<input type="text" name="InvoiceDate" id="InvoiceDate" class="form-control" style="width:30%" placeholder="Invoice Date">
		      			</div>
		      			<h3>Notes : </h3>		      			
		      			<div class="form-group">
							<textarea class="form-control txt" rows='5' name="data[notes]" id="notes" placeholder="Your Notes"></textarea>
						</div>						
		      		</div>
		      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						<span class="form-inline">
							<div class="form-group">
								<label>Subtotal: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="" type="number" class="form-control" name="data[subTotal]" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Tax: &nbsp;</label>
								<div class="input-group">									
									<input value="" type="number" class="form-control" name="data[tax]" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
									<div class="input-group-addon">%</div>
								</div>
							</div>
							<div class="form-group">
								<label>Tax Amount: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="" type="number" class="form-control" name="data[taxAmount]" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">									
								</div>
							</div>
							<div class="form-group">
								<label>Total: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="" type="number" class="form-control" name="data[totalAftertax]" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Paid: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="" type="number" class="form-control" name="data[amountPaid]" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
							<div class="form-group">
								<label>Amount Due: &nbsp;</label>
								<div class="input-group">
									<div class="input-group-addon currency">$</div>
									<input value="" type="number" class="form-control amountDue" name="data[amountDue]"  id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
								</div>
							</div>
						</span>
					</div>
		      	</div>
		      	<div class="clearfix"></div>
		    		      	
	      	</div>
		</form>			
    </div>
    <script src="hhh.js"></script>

    <!-- Jquery Date Picker -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!-- End Jquery Date Picker -->

    <script>
    	$('.submit_btn').on('click', function(){
    		$(this).button('loading');
        });

        $(document).ready(function(){
			$('.currency').html( $('#currency').val() );

			// Date picker
	    	$(function() {
		        $( "#InvoiceDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
		    });
       	});
        
		// $('#clientCompanyName').autocomplete({
  //   		source: function( request, response ) {
  //   			$.ajax({
  //   				url : 'ajax.php',
  //   				dataType: "json",
  //   				method: 'post',
  //   				data: {
  //   					name_startsWith: request.term,
  //   					type: 'customerName'
  //   				},
  //   				success: function( data ) {
  //   					response( $.map( data, function( item ) {
  //   						var code = item.split("|");
  //   							return {
  //   								label: code[1],
  //   								value: code[1],
  //   								data : item
  //   							}
  //   						}));
  //   					}
  //   				});
  //   		},
  //   		autoFocus: true,	      	
  //   		minLength: 1,
  //   		select: function( event, ui ) {
  //   			var names = ui.item.data.split("|");
  //   			$(this).val(names[1]);
  //   			getClientAddress(names[0]);
  //   		}		      	
  //   	});
    	// function getClientAddress(id){
    		
    	// 	 $.ajax({
     //    		 url: "ajax.php",
     //    		 method: 'post', 
     //    		 data:{id:id, type:'clientAddress'},
     //    		 success: function(result){
    	// 	        $("#clientAddress").html(result);
    	// 	    }
 		  //   });
     //   	}
   	       
    </script>
	
  </body>
</html>




