<?php
    include("WebService/accountinfo.php");
    include("WebService/forminfo.php");
    include("Account/expenseEmail.php");
    if (!$conn)
    {
        include("Database/config.php");		 
        $conn = getConnection();
    }
    $logged_in = false;
    if(isset($_SESSION['is_logged_in']))
    {
        $user_id = $_SESSION['userid'];
        $logged_in = true;
        $sql = "SELECT * FROM user WHERE user_id= '".$user_id."'";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {     
            $is_admin = $row['is_admin'];
        }
        
        $sql = "SELECT * FROM userAssignment WHERE userRole_id = (select userRole_id from userRole where userRole_Name ='Administrator' ) and user_id = '".$user_id."'";
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        
        $hasRoleAuthority = ( $num_rows == 1 || $is_admin ) == true ? true : false;
        $permissions = getPermissions($user_id, $conn);
       
        
    }
?>
<style type="text/css">
    td
    {
        padding: 0px 5px 0px 0px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Expense Reimbursement</title>
		<!-- Styles -->
		<link href="/Styles/css/bootstrap.css" rel="stylesheet">
		<link href="/Styles/css/customStyles.css" rel="stylesheet">
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/Scripts/bootstrap.min.js"></script>
	</head>
        <body>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                <div id="navbar" class="navbar-collapse collapse" style="float:none">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <?php
                                if(isset($_SESSION['is_logged_in']))
                                {
                            ?>
                           <a href="../home.php" style="font-weight:bold"><img alt="" class="img" src="images/logo.png" height="50px"></a>
                            <?php
                                }
                                else {
                            ?>
                            <a href="../index.php"style="font-weight:bold"><img alt="" class="img" src="images/logo.png" height="50px"></a>
                            <?php
                                }
                            ?>
                    </div>
                    <?php
                        if(!isset($_SESSION['is_logged_in']))
                        {
                    ?>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" float="right">
                        <form class="navbar-form navbar-right" action="Account/Login.php" method="post">
                            <table>
                                <tr >
                                    <td>
                                        <input type="text" placeholder="Email" class="form-control" name="Email">
                                    </td>
                                    <td>
                                        <input type="password" placeholder="Password" class="form-control" name="Password">
                                    </td>
                                    <td>
                                        <input type="submit" class="btn btn-success" value="Sign in" name="submit" />
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="padding-top: 5px;">
                                        <a href="../retrievepassword.php" >Forgot Password?</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="row">
                            <ul class="nav nav-tabs" style="border-bottom:0px;" role="tablist">
                                <li role="presentation" style="color:white; top:15px;">Hello <?php echo $_SESSION['name']; ?>!</li>
                                <li role="presentation">
                                    <div class="dropdown" style="top:15px;left:10px">
                                        <a data-toggle="dropdown">
                                            <span class="glyphicon glyphicon-triangle-bottom"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="account.php">My Account</a></li>
                                            <?php
                                                if ($hasRoleAuthority || in_array( 'User roles' , $permissions))
                                                {
                                            ?>
                                            <li><a href="userroles.php">User Roles</a></li>
                                            <?php
                                                }
                                                if ($hasRoleAuthority || in_array( 'User list' , $permissions))
                                                {
                                            ?>
                                            <li><a href="userlist.php">User List</a></li>
                                            <?php
                                                }
                                            ?>
                                            <li><a href="Account/logout.php">Logout</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </nav>   
    </body>
</html>
<script type="text/javascript" >
    function show_menu()
    {
        
    }
</script>
