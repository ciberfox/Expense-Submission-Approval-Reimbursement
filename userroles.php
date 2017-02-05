<?php
    session_start();
	$id = $_SESSION['userid'];

    
?>
<!DOCTYPE html>
<html>
    <header>
        <title>Expense Reimbursement</title>
        
		<!-- Styles -->
		<link href="/Styles/css/bootstrap.css" rel="stylesheet">
		<link href="/Styles/css/customStyles.css" rel="stylesheet">
		<!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="/Scripts/bootstrap.min.js"></script>
    </header>
    <body>
        <?php
		    include("Navbar/header.php");	
	    ?>
        <div class="container loggedInContainer" id="listAllRoles" align="center" >
            <div class="row">
                <div class="well panel panel-default" >
                    <div class="panel-body">
                        <div class="row">
                            <div>
                                <div class="container">
                                    <table style="width:100%"> 
                                        <tr>
                                            <td style="width:20%">
                                                Role Name
                                            </td style="width:60%">
                                            <td>
                                                Role Description
                                            </td>
                                            <td style="width:20%">
                                            </td>
                                        </tr>
                                        <?php
                                            $sql = "SELECT * FROM userRole";
                                            $result = mysqli_query($conn, $sql);
                                            while($row = mysqli_fetch_assoc($result))
                                            {    
                                                $userRole_id = $row['userRole_id'];
                                                $userRole_Name = $row['userRole_Name'];
                                                $userRole_Desc = $row['userRole_Desc'];
                                                $editRoleLink = 'configureroles.php?roleid='.$userRole_id;
                                                
                                        ?>
                                
                                        <tr>
                                            <td>
                                                <?php echo'<span style="width:65%">'.$userRole_Name.'</span>';?>
                                            </td>
                                            <td>
                                                <?php echo'<span>'.$userRole_Desc.'</span>';?>
                                            </td>
                                            <td>
                                                <?php echo'<a href="'.$editRoleLink.'"><span class="glyphicon glyphicon-pencil" title="Edit Role" ></span></a>'; ?>
                                                <?php echo '<a href="Roles/deleterole.php?roleid='.$userRole_id.'" title="Delete Role" ><span class="glyphicon glyphicon-remove"></span></a>'; ?>
                                            </td>
                                        </tr>
                                    
                                    <?php
                                        }
                                    ?>
                                    </table>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td>
                                                <a class="btn btn-default" onclick="addNewRole()" id="addNewRole" >Add New Role</a>
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container loggedInContainer" id="AddRole" align = "center" style="display:none;">
            <div class="row">
                <div class="well panel panel-default" >
                    <div class="panel-body">
                        <div class="row" align ="left">
                            <div >
                                <div class="container" align="left">
                                    <form action="Roles/addrole.php" method="post">
                                        <table>
                                            <tr>
                                                <td style="width:20%;">
                                                    Role Name:
                                                </td>
                                                <td style="width:80%;">
                                                    <input class="form-control" name="roleName" placeholder="Name of Role" required type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Role Description:
                                                </td>
                                                <td>
                                                    <input class="form-control" name="roleDesc" placeholder="Description of Role" type="text">
                                                </td>
                                            </tr>
                                        </table>
                                        <hr>
                                       <input id="submit" input type="submit" class="btn btn-success" value="Add Role" name="submit" />
                                        <a class="btn btn-default" onclick="cancelNewRole()" id="addNewRole" >Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function addNewRole()
        {
            $("#listAllRoles").css("display", "none");
            $("#AddRole").css("display", "");
        }
        function cancelNewRole()
        {
            $("#listAllRoles").css("display", "");
            $("#AddRole").css("display", "none");
        }
    </script>
</html>