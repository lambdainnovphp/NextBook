<?php 
include("includes/header.php");

if($_POST['submit']=="Save")
{
    $sql="INSERT INTO users(Firstname,Lastname,Username,email,password,OrganisationName,street1,street2,City,country,mobile) VALUES('".$_POST['firstName']."','".$_POST['lastName']."','".$_POST['UserName']."','".$_POST['UsEmail']."','".$_POST['PassWord']."','".$_POST['OrgName']."','".$_POST['Street1']."','".$_POST['Street2']."','".$_POST['City']."','".$_POST['Country']."','".$_POST['mobile']."')";
    $squery = mysql_query($sql);    
}
?>

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
                <td><input type="button" value="Cancel" style="width:60px;padding:5px;float:right;background:linear-gradient(to bottom, #64c8ef 0%,#00a2e2 100%);color:#fff;margin:15px 11px 0px 10px;">
                    <input type="submit" name="submit" value="Save" style="width:50px;padding:5px;float:right;">
                </td>
            </tr>
        </table>
    </form>

</section>
    </body>
</html>
