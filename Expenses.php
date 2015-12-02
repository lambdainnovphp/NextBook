<?php
include('includes/header.php');
$user = $_SESSION['Email'];
$Usql = "select * from users where email='".$user."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));

if($_POST['submit']=="Add Expense")
{
	$Exsql="INSERT INTO Expenses(UserId,Extitle,category,vendor,Amount,ExpenseDate,Notes,status) VALUES('".$_SESSION['Userid']."','".$_POST['Extitle']."','".$_POST['Excategory']."','".$_POST['ExVendor']."','".$_POST['Amount']."','".$_POST['ExDate']."','".$_POST['Exnotes']."','active')"; 
	$Exquery = mysql_query($Exsql);
    header('location:Expenses.php');
}
?>
<style>
#CreateCl input,textarea{	
	width:400px;
}
.input-medium
{
	width:100px !important;
}
small{
	padding:18px;
}
</style>
	<div id="container">
		Dashboard<br>
    	Welcome <?php echo $res_Usql['Firstname'];?>    
        <span id="newC" style="float:right; background-color:#ccc; padding:5px; cursor:pointer;">Create New Expense</span>
        <div id="CreateCl" style="display:none; padding-top:10px;">
        	<strong>New Expense</strong><br>
            <form name="NewExpense" method="post">
                <table>
					<tr>
                        <td>Title</td><td>: <input type="text" name="Extitle" id="Extitle" required></td>
                    </tr>
                    <tr>
                        <td>Amount</td><td>: <input type="text" name="Amount" id="Amount" required onkeypress="return IsNumeric(event)"></td>
                    </tr>
                    <tr>
                        <td>Date</td><td>: <input type="text" name="ExDate" id="ExDate" required></td>
                    </tr>
                    <tr>
                        <td>Vendor</td><td>: <input type="text" name="ExVendor" id="ExVendor" required></td>
                    </tr>
                    <tr>
                        <td>Category</td><td>: <input type="text" name="Excategory" id="Excategory" required></td>
                    </tr>
                    <tr>
                        <td>Notes</td><td>: <input type="text" name="Exnotes" id="Exnotes" required></td>
                    </tr>                    
                    <tr>
                        <td></td><td>&nbsp;&nbsp;
                        <input type="button" id="newCancel"  style="background-color:#093;color:#fff;width:70px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:14px;float:right;cursor:pointer;margin:15px 0px 0px 5px;" value="Cancel">
                        <input type="submit" name="submit" value="Add Expense" style="background-color:#093;color:#fff;width:110px; font-family:Georgia, 'Times New Roman', Times, serif;font-size:14px;float:right;">                        
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>

        <?php if($_GET['click']!="Edit" && $_GET['SortExp']==""){?>
        
            <div id="showclient" style="margin-top:10px;">
            	<table cellspacing="20">
                    <thead>
                        <tr class="filters">
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Notes</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>               
                    </thead>
                    <tbody>
                    <?php 
                    $ViewExsql = "SELECT * FROM Expenses";
                    $Exresult = mysql_query($ViewExsql);
                    $Ekl = 1;
                    while($Exrow = mysql_fetch_array($Exresult)){ ?>               
                        <tr>
                        	<td><?php echo $Ekl;?></td>
                            <td><?php echo $Exrow['ExpenseDate']?></td>
                            <td><?php echo $Exrow['category']?></td>
                            <td><?php echo $Exrow['Notes']?></td>
                            <td><?php echo $Exrow['Amount']?></td>
                            <td><a href="Expenses.php?click=Edit&SortExp=<?php echo $Exrow['id']; ?>">Edit</a></td>
                        </tr>
                    <?php $Ekl++; }?>		
                        
                    </tbody>
                </table>            	
            </div>

        <?php } else { 
            $IndExp = mysql_query("Select * from expenses where id='".$_GET['SortExp']."'");
            $Res_IndExp = mysql_fetch_assoc($IndExp);?>

            <div id="editExpense" style="margin-top:10px;">
                <form name="editExpform" method="post">
                    <table>
                        <tr>
                            <td>Amount</td>
                            <td>Date</td>
                            <td>Vendor</td>
                            <td>Category</td>
                            <td>Notes</td>
                        </tr>

                        <tr>
                            <td><input type="text" name="ExPAmount" id="ExPAmount" value="<?php echo $Res_IndExp['Amount'];?>" style="width:65px;" ></td>
                            <td><input type="text" name="ExPDate" id="ExPDate" value="<?php echo $Res_IndExp['ExpenseDate'];?>" style="width:70px;" ></td>
                            <td><input type="text" name="ExPVendor" id="ExPVendor" value="<?php echo $Res_IndExp['vendor'];?>" style="width:80px;" ></td>
                            <td><input type="text" name="ExPCategory" id="ExPCategory" value="<?php echo $Res_IndExp['category'];?>" style="width:120px;" ></td>
                            <td><textarea name="ExPNotes" id="ExPNotes" style="width: 150px; height:15px; resize: none; overflow: hidden; display: block;"><?php echo $Res_IndExp['Notes'];?></textarea></td>
                        </tr>

                        <tr>
                            <td colspan="2"><input type="checkbox" name="Staxes" id="Staxes" onclick="showDrop('taxs');">Taxes</td>
                            <td><input type="checkbox" name="SRecurring" id="SRecurring" onclick="showDrop('Recc');">Recurring</td>
                            <td><input type="checkbox" name="SAssign" id="SAssign" onclick="showDrop('Assgn');">Assign To Client</td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div id="showtas" style="width:130px;display:none;">
                                    <table>
                                        <tr>
                                            <td>Tax 1<br><input type="text" name="taxs1" id="taxs1" style="width:50px;"></td>
                                            <td>Amount<br><input type="text" name="taxs1Amt" id="taxs1Amt" style="width:50px;"></td>
                                        </tr>
                                        <tr>
                                            <td>Tax 2<br><input type="text" name="taxs2" id="taxs2" style="width:50px;"></td>
                                            <td>Amount<br><input type="text" name="taxs2Amt" id="taxs2Amt" style="width:50px;"></td>
                                        </tr>                                        
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div id="showRecc" style="width:100px;display:none;">
                                    <table>
                                        <tr>
                                            <td>Frequency<br>
                                                <select name="RecFreq" id="RecFreq" style="width:75px;">
                                                    <option value="weekly">Weekly</option>
                                                    <option value="2weeks">2 Weeks</option>
                                                    <option value="4weeks">4 Weeks</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="2months">2Months</option>
                                                    <option value="3months">3Months</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Until<br>
                                                <select name="RecUntil" id="RecUntil" style="width:75px;" onchange="showEndate(this.value)">
                                                    <option value="forever">Forever</option>
                                                    <option value="Endate">End Date</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="showeDate" style="display:none;">
                                            <td>End Date<br><input type="text" name="RecEndDate" id="RecEndDate" style="width:75px;"></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div id="showAssgn" style="width:130px;display:none;">
                                    <table>
                                        <tr>
                                            <td>Client<br><input type="text" name="AssgnCl" id="AssgnCl" style="width:75px;"></td>
                                        </tr>
                                        <tr>
                                            <td>Until<br><input type="text" name="AssgnProject" id="AssgnProject" style="width:75px;"></td>
                                        </tr>                                        
                                    </table>
                                </div>
                            </td>
                            <td></td>
                        </tr>

                    </table>
                </form>
            </div>

        <?php } ?>

            
	</div>
    
   	<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script> 
    <!-- Jquery Date Picker -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">    
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- End Jquery Date Picker -->
	<script type="text/javascript">
	$(document).ready(function(){
		$('#CreateCl').hide();
		$("#newC").on('click',function(){			
			$("#CreateCl").slideDown('slow');
            $('#newC').hide();
		});	

        $('#newCancel').on('click',function(){
            $("#CreateCl").slideUp('slow');
            $('#newC').show();
        });

        $('#ExPNotes')

        // Date picker
        $(function() {
            $( "#ExDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
            $( "#ExPDate" ).datepicker({ dateFormat: 'dd-mm-yy' });
            $( "#RecEndDate" ).datepicker({ dateFormat: 'dd-mm-yy' });            
        });
	});

    // Show checked
    function showDrop(Vals)
    {
        //Taxes
        if(Vals == "taxs")
        {
            if (document.getElementById('Staxes').checked) {
                $('#showtas').slideDown();
            } 
            else
            {
                $('#showtas').slideUp();
            }
        }
        //Reccuring 
        if(Vals == "Recc")
        {
            if (document.getElementById('SRecurring').checked) {                
                $('#showRecc').show();
                $('#showtas').css('margin-top','-45px');
                $('#showAssgn').css('margin-top','-45px');
            }
            else
            {
                $('#showRecc').hide();
                $('#showtas').css('margin-top','0px');
                $('#showAssgn').css('margin-top','0px');
            } 
        }        
        // Assign clients
        if(Vals == "Assgn")
        {
            if (document.getElementById('SAssign').checked) {
                $('#showAssgn').slideDown();
            } 
            else
            {
                $('#showAssgn').slideUp();
            }
        }        
    }

    function showEndate(sww)
    {
        if(sww == "Endate")
        {
            $('#showeDate').show();
        }
    }


    var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        specialKeys.push(9); //Tab
        specialKeys.push(46); //Delete
        specialKeys.push(36); //Home
        specialKeys.push(35); //End
        specialKeys.push(37); //Left
        specialKeys.push(39); //Right

    function IsNumeric(e) {
        var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
        if((keyCode >= 48 && keyCode <= 57) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode))
        {
            var ret = ((keyCode >= 48 && keyCode <= 57) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
        }
        else
        {
            alert('Numbers Only');
            var ret = ((keyCode >= 48 && keyCode <= 57) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
        }
        //document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }
	</script>

</body>

</html>