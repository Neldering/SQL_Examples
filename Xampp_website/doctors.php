<?php

require_once("connect.php");
require_once("services/DocService.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <script src="https://use.fontawesome.com/2b90d30d0a.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
</head>
<body>
<div id="body" class="container-fluid">
    <div id="header" class="row">
        <h1 class="text-center">Pharmacy</h1>
    </div>
    <div id="main" class="flex-row">
        <div id="sidebar" class="col-md-2">
            <a href="index.php">Home</a>
            <a href="doctors.php">Doctors</a>
            <a href="prescriptions.php">Prescriptions</a>
            <a href="medicines.php">Medications</a>
            <a href="customers.php">Customers</a>
            <a href="admin.php">Admin</a>
        </div>
        <div id="content" class="col-md-10">
            <div id="inner-content">
                <div id="Doctors">
                    <h2>Doctors</h2>
                    <hr/>

                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Doctor ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Zip</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach (DocService::Instance()->getAllDocs() as $doc) {
                                echo '<tr>';
                                echo '<td>' . $doc["Doctor_ID"] . '</td>';
                                echo '<td>' . $doc["Doctor_Name"] . '</td>';
                                echo '<td>' . $doc["Doctor_ZIP"] . '</td>';
                                echo '<td>
                                        <form id="newCustomerForm" method="POST" action="controllers/doctor/DeleteDoc.php">
                                        <input type="hidden" name="redirect" value="../../doctors.php"/>
                                        <input type="hidden" name="doc-id" value="' . $doc["Doctor_ID"] . '" />
                                        <button class="btn btn-md btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                     </td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="new-Doctor">
                    <h2>New Doctor</h2>
                    <hr/>
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo '<p class="error">' . $_SESSION['error'] . '</p>';
                        $_SESSION['error'] = '';
                    }
                    if (isset($_SESSION['success'])) {
                        echo '<p class="success">' . $_SESSION['success'] . '</p>';
                        $_SESSION['success'] = '';
                    }
                    ?>
                    <form id="newCustomerForm" method="POST" action="controllers/doctor/CreateDoc.php">
                        <input type="hidden" name="redirect" value="../../doctors.php"/>
                        <div class="input-group col-md-4">
                            <input class="form-control" type="text" name="Doctor_Name" placeholder="Name" autofocus>
                        </div>
                        <div class="input-group col-md-4">
                            <input class="form-control" type="number" name="Doctor_ZIP" placeholder="Zip">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary align-items-center">Create Doctor</button>
                        </div>
                    </form>
					<script type="text/javascript" >
								//Popup window code
								function newPopup(url){
									popupWindow = window.open (
								url, 'popUpWindow','height=300,width=700,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
								}
						</script>
						
						<br>
						<div class"col-md-2" onclick="newPopup('controllers/customer/PatientOf.php')">
							<button class="btn btn-secondary align-items-center"> Patient List </button>
				        </div>
						
						<br>
						<div class"col-md-2" onclick="newPopup('controllers/doctor/DoctorWrote.php')">
							<button class="btn btn-secondary align-items-center"> Prescriptions grouped by Doctor </button>
				        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>