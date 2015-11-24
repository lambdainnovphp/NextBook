<!DOCTYPE html>
<html>
    <head>
        <title>NextBook Login</title>  
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section class="loginform cf">
<?php include("dbconfig.php");
if($_SESSION['Email']=="")
{
    if($_POST['submit']=="Login")
    {
        $sql="select * from users where email='".$_POST['usermail']."' and password='".$_POST['Upassword']."'"; 
        $squery = mysql_query($sql);
        $loggedvals = mysql_fetch_assoc($squery);
        if(mysql_num_rows($squery)>0)
        {
            $_SESSION['Email']=$_POST['usermail'];
            $_SESSION['Userid'] = $loggedvals['id'];
            header('location:index.php');
        }
        else
        {
            header('location:index.php');
        }
    }
?>
    <form name="login" method="post">
        <ul>
            <li>
                <label for="usermail">Email</label>
                <input type="email" name="usermail" placeholder="yourname@email.com" required>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="Upassword" placeholder="password" required></li>
            <li>
                <input type="submit" name="submit" value="Login">
            </li>
        </ul>
    </form>

<?php
}
else 
{
    $Usql = "select * from users where email='".$_SESSION['Email']."'";
    $res_Usql=mysql_fetch_assoc(mysql_query($Usql));
?>

    Welcome <?php echo $res_Usql['Firstname'];?>
    <br><br>
    <table>
        <tr>
            <td>Invoices</td>
            <td>Expenses</td>
        </tr>
        <tr align="center">
            <td>
            <?php 
                $InvCount = mysql_query("Select * from invoice where UserId='".$_SESSION['Userid']."'");
                echo $InvCVals = mysql_num_rows($InvCount);
            ?>
            </td>
            <td>
            <?php 
                $ExpCount = mysql_query("Select * from expenses where UserId='".$_SESSION['Userid']."'");
                echo $ExpCVals = mysql_num_rows($ExpCount);                 
            ?>
            </td>
        </tr>
    </table> 

<?php } ?>

        </section>
    </body>
</html>
