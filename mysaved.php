<html> 
    <body>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered">
            	<thead>
            		<tr>
            			<th>ID #</th>
            			<th>Submitter</th>
            			<th>Approver</th>
            			<th>Submission Date</th>
            			<th>Approval Date</th>
            			<th>Status</th>            			
            			<th style="text-align:center">View Form</th>
            		</tr>
            	</thead>
                <tbody>
                    <?php
                    // First checks if expense form is set to Saved, then
                    // checks whether the user role is admin, submitter, approver, or submitter and approver (lower admin version)
                    // then assigns that current user a table based on thier session user id.
                    if(isMySaved($_SESSION['userid'], $conn)){
                        if(isadmin($_SESSION['userid'], $conn)){
                            getSandATable($_SESSION['userid'], $conn);
                        }
                        else if(isSubmitterAndApprover($_SESSION['userid'], $conn)){
                            getSandATable($_SESSION['userid'], $conn);
                        }
                        else if(isSubmitter($_SESSION['userid'], $conn)){
                            getSubmitterTable($_SESSION['userid'], $conn, "Saved");
                        }
                        else if(isApprover($_SESSION['userid'], $conn)){
                            getApproverTable($_SESSION['userid'], $conn, "Saved");
                        }
                       
                        else{
                            echo "<td colspan='7' align='center'>No Results or History.</td>";
                        }
                    }
                    else{
                       echo "<td colspan='7' align='center'>No Results or History.</td>"; 
                    }
                    ?>
               </tbody>
            </table>            
        </div>
    </div>	

</body>
</html>