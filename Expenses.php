<?php
include('includes/header.php');
$user = $_SESSION['Email'];
$Usql = "select * from users where email='".$user."'";
$res_Usql=mysql_fetch_assoc(mysql_query($Usql));

if($_POST['submit']=="Add Expense")
{
    print_r($_POST); exit;
	$Exsql="INSERT INTO Expenses(ExpenseName,Category,vendor,Amount,Expen_Date,Notes) VALUES('".$_POST['Extitle']."','".$_POST['Excategory']."','".$_POST['ExVendor']."','".$_POST['Amount']."','".$_POST['ExDate']."','".$_POST['Exnotes']."')"; 
	$Exquery = mysql_query($Exsql);
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
                        <td>Amount</td><td>: <input type="text" name="Amount" id="Amount" required></td>
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
        
        <div id="showclient">
        	<table cellspacing="20">
            <thead>
                <tr class="filters">
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Notes</th>
                    <th>Amount</th>
                </tr>               
            </thead>
            <tbody>
            <?php 
            $ViewExsql = "SELECT * FROM Expenses";
            $Exresult = mysql_query($ViewExsql);
            $Ekl = 1;
            while($Exrow = mysql_fetch_array($Exresult)){ ?>               
                <tr>
                	<td><?php echo $jkl;?></td>
                    <td><?php echo $Exrow['Expen_Date']?></td>
                    <td><?php echo $Exrow['Category']?></td>
                    <td><?php echo $Exrow['Notes']?></td>
                    <td><?php echo $Exrow['Amount']?></td>
                </tr>
            <?php $Ekl++; }?>											
                
            </tbody>
        </table>
        	
        </div>
            
	</div>
    
   	<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script> 
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
	});
	</script>

</body>
</html>