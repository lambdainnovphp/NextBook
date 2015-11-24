<?php 
include("dbconfig.php");
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
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NextBook SignUp</title>  
        <link rel="stylesheet" href="style.css">

        <style type="text/css">
        .loginform input{
            width:200px;        
        }
        </style>
    </head>
    <body>
        <section class="loginform cf">

            <form name="signUpProc" method="post">
                <table>
                    <tr>
                        <td>FirstName</td>
                        <td>: <input type="text" name="firstName" placeholder="First Name" required></td>
                    </tr>
                    <tr>
                        <td>LastName</td>
                        <td>: <input type="text" name="lastName" placeholder="Last Name" required></td>
                    </tr>
                    <tr>
                        <td>UserName</td>
                        <td>: <input type="text" name="UserName" placeholder="Enter UserName" required></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td>: <input type="email" name="UsEmail" placeholder="Enter Your Email" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>: <input type="password" name="PassWord" placeholder="Enter Password" required></td>
                    </tr>
                    <tr>
                        <td>Organisation Name</td>
                        <td>: <input type="text" name="OrgName" placeholder="Organisation Name" required></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>: <input type="text" name="Street1" placeholder="Street 1" required style="width:87px">
                        <input type="text" name="Street2" placeholder="Street 2" required style="width:87px">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>: <input type="text" name="City" placeholder="City / State" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>: <input type="text" name="Country" placeholder="Country" required></td>
                    </tr>
                    <tr>
                        <td>Mobile </td>
                        <td>: <input type="text" name="mobile" placeholder="Mobile No." required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>: <input type="submit" name="submit" placeholder="City / State" required></td>
                    </tr>
                </table>
            </form>

        </section>
    </body>
</html>
