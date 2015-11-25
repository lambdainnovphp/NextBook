<?php
include('includes/header.php');
$user = $_SESSION['Email'];
$Usql = "select * from users where email='".$user."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));

if($_POST['submit']=="Save")
{    
	$sql="INSERT INTO invoice(organizationName,email,contactName,mobile,country,street1,street2,city,state,zip,industry,companySize,businessPhone,fax,internalNotes) VALUES('".$_POST['OrgName']."','".$_POST['CEmail']."','".$_POST['ContName']."','".$_POST['CMobile']."','".$_POST['Ccountry']."','".$_POST['CStreet1']."','".$_POST['CStreet2']."','".$_POST['CCity']."','".$_POST['CState']."','".$_POST['CZipcode']."','".$_POST['CIndustry']."','".$_POST['CcompanySize']."','".$_POST['CBusPhone']."','".$_POST['CFax']."','".$_POST['Cnotes']."')"; 
	$squery = mysql_query($sql);
}
?>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script> 
<!-- Jquery Date Picker -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- End Jquery Date Picker -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#CreateCl').hide();
        $("#newC").on('click',function(){
            $('#showclient').hide();
            $("#CreateCl").slideDown('slow');
            $('#newC').hide();
        }); 
        $('#newCancel').on('click',function(){
            $('#showclient').show();
            $("#CreateCl").slideUp('slow');
            $('#newC').show();
        });
    });
</script>
<style>
#CreateCl input,textarea{	
	width:400px;
	padding:10px;
}
.input-medium
{
	width:100px !important;
}
small{
	padding:18px;
}
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
.form-div input
{
    width: 70px !important;
}
</style>
	<div id="container">
		Dashboard<br>
        	Welcome <?php echo $res_Usql['Firstname'];?>    
            <span id="newC" style="float:right; background-color:#ccc; padding:5px; cursor:pointer;">Create New Invoice</span>            
        <div id="CreateCl" style="display:block; padding-top:10px;">
        	<strong>New Invoice</strong><br>
            <form name="NewInvoice" method="post">

                <div style="width:620px;" class="form-div">
                    <div class="left-div">
                        <table>
                            <tr>
                                <td><b>Client</b>
                                    <select name="ClientName" id="ClientName" style="width:200px;">
                                        <option value=""></option>
                                        <?php 
                                        $Clisql = "select * from client";
                                        $res_Clisql=mysql_query($Clisql);
                                        while($ress = mysql_fetch_array($res_Clisql)){?>
                                            <option value="<?php echo $ress['clientId'];?>"><?php echo $ress['organizationName'];?> (<?php echo $ress['contactName'];?>)</option>
                                        <?php } ?>
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
                            <tr id="addtaskss" style="display:none;">
                                <td></td><td><span id="adding">add Tasks</span></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Tasks -->
                    <span id="addtaskcol">Add</span>
                    <table id="tasks" style="width:100%;">                        
                            <tr style="background-color:#ccc;">                                
                                <td>Task</td>
                                <td>Time Entry Notes</td>
                                <td>Rate</td>
                                <td>Hours</td>
                                <td>Tax</td>
                                <td>Tax</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
                        
                            <tr id="indTask">                                
                                <td>
                                    <select name="tasksdet[]" id="tasksdet" class="select" style="width:92px; height:37px;"><!-- display:none; -->
                                        <option value=""></option>
                                        <?php $sqql = mysql_query("select * from tasks");
                                              while ($resqql = mysql_fetch_array($sqql)) {?>
                                                <option value="<?php echo $resqql['taskId'];?>"><?php echo $resqql['taskName'];?></option>
                                        <?php } ?>     
                                    </select>
                                    <!-- <input type="text" name="taskName[]" id="taskName"> -->
                                </td>
                                <td><input type="text" name="taskDesc[]" id="teskDesc"></td>
                                <td><input type="text" name="taskRate[]" id="taskRate" style="text-align:right;"></td>
                                <td><input type="text" name="taskHours[]" id="taskHours" style="text-align:right;"></td>
                                <td><input type="text" name="tasktax1[]" id="tasktax1"></td>
                                <td><input type="text" name="tasktax2[]" id="tasktax2"></td>
                                <td><span id="tasktot">0</span><input type="hidden" name="tasktotal[]" id="tasktotal"></td>
                                <td><button type="button" class="removebutton" title="Remove this row">X</button></td>
                            </tr>
                        
                    </table>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $('#addtaskcol').click(function(){
                            var tabtex = $('#tasks tr:last').clone();              
                            $('#tasks tr:last').after(tabtex);  
                            $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
                            $('#tasks tr:last').find('#tasktot').html('0');        
                        });

                        $(document).on('click','button.removebutton',function(){                            
                            var rowCount = $('#tasks tr').length;         
                            if(rowCount == 2)
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

                        $('#adding').click(function(){
                            $('#tasks').show();
                            $('#addtaskcol').show();
                            $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
                            $('#tasks tr:last').find('#tasktot').html('0');         
                        });                       

                        $(document).on('change','#tasksdet',function(){        
                            var swws = $(this).closest('td').find("#tasksdet option:selected").val();         
                            $.ajax({
                                url:"getdata.php",
                                type:"GET",
                                data: {"taskVal": swws,"mode":"tasksVals"},
                                success:function(dat){
                                    $('#indTask').html(dat);    
                                }
                            });                            
                        });

                        $(document).on('blur','#taskRate',function(){                            
                            var trate = $(this).val();
                            var thour = $(this).closest('tr').find('input[id="taskHours"]').val();                                              
                            var mult = trate * thour;
                            $(this).closest('tr').find('#tasktot').text(mult);
                            $('#tasktotal').val(mult);
                        });

                        $(document).on('blur','#taskHours',function(){                            
                            var trate = $(this).closest('tr').find('input[id="taskRate"]').val();                            
                            var thour = $(this).val();
                            var mult = trate * thour;
                            $(this).closest('tr').find('#tasktot').text(mult);
                            $('#tasktotal').val(mult);
                        });     


                    });
                    </script>
                    <!-- End Tasks -->

                </div>
                
                <br>
                <table style="margin-left:320px;">
                    <tr>
                        <td></td>
                        <td>&nbsp;&nbsp;<input type="submit" name="submit" value="Save" style="background-color:#093;color:#fff;width:200px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:18px;float:left; cursor:pointer;">
                        <input type="button" id="newCancel"  style="background-color:#093;color:#fff;width:150px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:18px;float:right; cursor:pointer;" value="Cancel">
                        </td>
                    </tr>
                </table>

            </form>
            
        </div>  

<!-- Editing process -->

    <?php if($_GET['Inedit']!=''){  

            $Invedit = mysql_query("Select * from invoice where id='".$_GET['Inedit']."'");
            $res_Inved = mysql_fetch_assoc($Invedit);
            ?>
                <div id="CreateCl" style="display:block; padding-top:10px;">
                    <strong><?php echo $res_Inved['invoiceId'];?> Invoice</strong><br>
                    <form name="NewInvoice" method="post">

                        <div style="width:620px;" class="form-div">
                            <div class="left-div">
                                <table>
                                    <tr>
                                        <td><b>Client</b>
                                            <select name="ClientName" id="ClientName" style="width:200px;">
                                                <option value=""></option>
                                                <?php 
                                                $Clisql = "select * from client";
                                                $res_Clisql=mysql_query($Clisql);
                                                while($ress = mysql_fetch_array($res_Clisql)){?>
                                                    <option value="<?php echo $ress['clientId'];?>"><?php echo $ress['organizationName'];?> (<?php echo $ress['contactName'];?>)</option>
                                                <?php } ?>
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
                                    <tr id="addtaskss" style="display:none;">
                                        <td></td><td><span id="adding">add Tasks</span></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Tasks -->
                            <span id="addtaskcol">Add</span>
                            <table id="tasks" style="width:100%;">                        
                                    <tr style="background-color:#ccc;">                                
                                        <td>Task</td>
                                        <td>Time Entry Notes</td>
                                        <td>Rate</td>
                                        <td>Hours</td>
                                        <td>Tax</td>
                                        <td>Tax</td>
                                        <td>Total</td>
                                        <td></td>
                                    </tr>
                                
                                    <tr id="indTask">                                
                                        <td>
                                            <select name="tasksdet[]" id="tasksdet" class="select" style="width:92px; height:37px;"><!-- display:none; -->
                                                <option value=""></option>
                                                <?php $sqql = mysql_query("select * from tasks");
                                                      while ($resqql = mysql_fetch_array($sqql)) {?>
                                                        <option value="<?php echo $resqql['taskId'];?>"><?php echo $resqql['taskName'];?></option>
                                                <?php } ?>     
                                            </select>
                                            <!-- <input type="text" name="taskName[]" id="taskName"> -->
                                        </td>
                                        <td><input type="text" name="taskDesc[]" id="teskDesc"></td>
                                        <td><input type="text" name="taskRate[]" id="taskRate" style="text-align:right;"></td>
                                        <td><input type="text" name="taskHours[]" id="taskHours" style="text-align:right;"></td>
                                        <td><input type="text" name="tasktax1[]" id="tasktax1"></td>
                                        <td><input type="text" name="tasktax2[]" id="tasktax2"></td>
                                        <td><span id="tasktot">0</span><input type="hidden" name="tasktotal[]" id="tasktotal"></td>
                                        <td><button type="button" class="removebutton" title="Remove this row">X</button></td>
                                    </tr>
                                
                            </table>
                            <script type="text/javascript">
                            $(document).ready(function(){
                                $('#addtaskcol').click(function(){
                                    var tabtex = $('#tasks tr:last').clone();              
                                    $('#tasks tr:last').after(tabtex);  
                                    $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
                                    $('#tasks tr:last').find('#tasktot').html('0');        
                                });

                                $(document).on('click','button.removebutton',function(){                            
                                    var rowCount = $('#tasks tr').length;         
                                    if(rowCount == 2)
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

                                $('#adding').click(function(){
                                    $('#tasks').show();
                                    $('#addtaskcol').show();
                                    $('#tasks tr:last').find('input[type="text"],input[type="hidden"]').val("");   
                                    $('#tasks tr:last').find('#tasktot').html('0');         
                                });                       

                                $(document).on('change','#tasksdet',function(){        
                                    var swws = $(this).closest('td').find("#tasksdet option:selected").val();         
                                    $.ajax({
                                        url:"getdata.php",
                                        type:"GET",
                                        data: {"taskVal": swws,"mode":"tasksVals"},
                                        success:function(dat){
                                            $('#indTask').html(dat);    
                                        }
                                    });                            
                                });

                                $(document).on('blur','#taskRate',function(){                            
                                    var trate = $(this).val();
                                    var thour = $(this).closest('tr').find('input[id="taskHours"]').val();                                              
                                    var mult = trate * thour;
                                    $(this).closest('tr').find('#tasktot').text(mult);
                                    $('#tasktotal').val(mult);
                                });

                                $(document).on('blur','#taskHours',function(){                            
                                    var trate = $(this).closest('tr').find('input[id="taskRate"]').val();                            
                                    var thour = $(this).val();
                                    var mult = trate * thour;
                                    $(this).closest('tr').find('#tasktot').text(mult);
                                    $('#tasktotal').val(mult);
                                });     


                            });
                            </script>
                            <!-- End Tasks -->

                        </div>
                        
                        <br>
                        <table style="margin-left:320px;">
                            <tr>
                                <td></td>
                                <td>&nbsp;&nbsp;<input type="submit" name="submit" value="Save" style="background-color:#093;color:#fff;width:200px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:18px;float:left; cursor:pointer;">
                                <input type="button" id="newCancel"  style="background-color:#093;color:#fff;width:150px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:18px;float:right; cursor:pointer;" value="Cancel">
                                </td>
                            </tr>
                        </table>

                    </form>
                    
                </div>


    <?php } else { ?>
        
        <div id="showclient">
        	<table cellspacing="20">
            <thead>
                <tr class="filters">
                    <th>S.No</th>
                    <th>Invoice</th>
                    <th>Client Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>               
            </thead>
            <tbody>
            <?php 
            $ViewClsql = "SELECT * FROM invoice";
            $Clresult = mysql_query($ViewClsql);
            $jkl = 1;
            while($row = mysql_fetch_array($Clresult)){ ?>               
                <tr>
                	<td><?php echo $jkl;?></td>
                    <td><?php echo $row['invoiceId']?></td>
                    <td><?php echo $row['organizationName']?></td>
                    <td><?php echo $row['firstName']?></td>                    
                    <td><?php echo $row['dateOfIssue']?></td>
                    <td><?php echo $row['InvAmount']?></td>           
                    <td><?php echo $row['status']?></td>           
                    <td><a href="Invoices.php?Inedit=<?php echo $row['id'];?>">Edit</a></td>
                </tr>
            <?php $jkl++; }?>											
                
            </tbody>
            </table>        	
        </div>

    <?php }?>
            
	</div>
       	
	<script type="text/javascript">	
    $(function() {
        $( "#InvoiceDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
    });  

    $(document).ready(function(){        
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
    });
	</script>

</body>
</html>