<?php
require("include.php");
require("protect.php");


// like version 0.1
// currently as PoC and should not be used


/*
Stuff to do:
  Sanitize login credentials
  relookup DN or sanitize and validate DN from post on password change
  fix up lazy coding
*/



// output for jquery
if ($pageMode==="json") {
    $students['data'] = getStudents();
    echo json_encode($students);
    die();
}

if ($pageMode==="changePass") {
    if (!empty($_POST["pass"])) {
        $pass = trim($_POST["pass"]);
    } else {
        die("Password cannot be blank");
    }

    $dn = $_POST['dn'];
    //validate DN and pass here
    $user = getUser($dn, $settings['ldap_studentou']); //safer way to filter DN
    $dn = $user['dn'];
    //if (in_array($settings['ldap_studentsg'], $user['memberof'])) { //check this in future
    if (strpos(strtolower($dn),strtolower($settings['ldap_studentou']))) { //basic check to at least ensure user is within student OU
        $vals['unicodePwd'] = encodePass($pass);
        modUser($dn, $vals);
    } else {
        echo "Failed. Check 1";
    }
    die();
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Students</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/b-1.6.1/fh-3.1.6/sl-1.3.1/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="passwords.css"/>
    </head>
    <body>
        <div class="container">
        <?php echo $_SESSION['name'];?> <?php echo $_SESSION['username']; ?> <a href="login.php?mode=logout">Logout</a>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>Surname</th>
                        <th>Given Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/b-1.6.1/fh-3.1.6/sl-1.3.1/datatables.min.js"></script>
        <script type="text/javascript" src="passwords.js"></script>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Student Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="dn">
                        <span id="results"></span>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick=submit()>Change Password</button>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>