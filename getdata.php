<?php
include('dbconfig.php');

if($_GET['mode']=="Clientdata")
{
    $exCLsql = "Select * from client where clientId='".$_GET['ClientVal']."'";
    $res_exCLsql = mysql_fetch_assoc(mysql_query($exCLsql));?>

    <div>
        <table>
            <tr>
                <td valign="top"><b>Address</b></td>
                <td><?php echo $res_exCLsql['organizationName'];?><br>
                  <?php echo $res_exCLsql['street1'];?><br>
                  <?php echo $res_exCLsql['street1'];?><br>
                  <?php echo $res_exCLsql['city'];?><?php echo $res_exCLsql['state'];?>&nbsp;<?php echo $res_exCLsql['zip'];?><br>
                  <?php echo $res_exCLsql['country'];?>
                </td>
            </tr>
        </table>
    </div>
    
<?php }

if($_GET['mode']=="tasksVals")
{  
  $taskVsql = "Select * from tasks where taskId='".$_GET['taskVal']."'";
  $res_taskVsql = mysql_fetch_assoc(mysql_query($taskVsql));?>

    <td>
      <select name="tasksdet[]" id="tasksdet" class="select" style="width:92px; height:37px;">
          <option value=""></option>
          <?php $sqql = mysql_query("select * from tasks");
                while ($resqql = mysql_fetch_array($sqql)) {?>
                  <option value="<?php echo $resqql['taskId'];?>"><?php echo $resqql['taskName'];?></option>
          <?php } ?>     
      </select>
      <script type="text/javascript">
      for(var i=0;i<document.getElementById('tasksdet').length;i++)
      {
        if(document.getElementById('tasksdet').options[i].value=="<?php echo $_GET['taskVal']; ?>")
        {
          document.getElementById('tasksdet').options[i].selected=true
        }
      }     
      </script>
    </td>
    <td><input type="text" name="taskDesc[]" id="teskDesc" value="<?php echo $res_taskVsql['task_Description'];?>"></td>
    <td><input type="text" name="taskRate[]" id="taskRate" style="text-align:right;" value="<?php echo $res_taskVsql['rate'];?>"></td>
    <td><input type="text" name="taskHours[]" id="taskHours" style="text-align:right;"></td>
    <td><input type="text" name="tasktax1[]" id="tasktax1"></td>
    <td><input type="text" name="tasktax2[]" id="tasktax2"></td>
    <td><span id="tasktot">0</span><input type="hidden" name="tasktotal[]" id="tasktotal"></td>
    <td><button type="button" class="removebutton" title="Remove this row">X</button></td>

<?php } ?>
