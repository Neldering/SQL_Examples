<html>
<head>
<title>Get Prescription</title>


<link rel="stylesheet" href="styles.css">


</head>
<body>

<p>
<?php
// Get a connection for the database
require_once('../mysqli_connect.php'); //←--this assumes you put mysqli in xampp and not htdocs
// Create a query for the database
$query = "SELECT Pre.Prescription_ID, customer.Customer_Name, Doc.Doctor_Name, med.Med_Name, Pre.Refill_Amount, Pre.Date_Writen
FROM rescription as Pre 
join doctor as Doc on Doc.Doctor_ID = Pre.Doctor_ID
JOIN customer on customer.Customer_ID = Pre.Customer_ID
JOIN med on med.Med_ID = Pre.Med_ID";
// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);
// If the query executed properly proceed
if($response){
echo '<table align="left"
cellspacing="5" cellpadding="8">
<tr><td align="left"><b>Prescription_ID</b></td>
<td align="left"><b>Doctor</b></td>
<td align="left"><b>Customer</b></td>
<td align="left"><b>Med</b></td>
<td align="left"><b>Refill Amount</b></td>
<td align="left"><b>Date Writen</b></td></tr>';
// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){
echo '<tr><td align="left">' . 
$row['Prescription_ID'] . '</td><td align="left">' . 
$row['Doctor_Name'] . '</td><td align="left">' . 
$row['Customer_Name'] . '</td><td align="left">' . 
$row['Med_Name'] . '</td><td align="left">' . 
$row['Refill_Amount'] . '</td><td align="left">' .
$row['Date_Writen'] . '</td><td align="left">' ;
echo '</tr>';
}
echo '</table>';
} else {
echo "Couldn't issue database query<br />";
echo mysqli_error($dbc);
}
// Close connection to the database
mysqli_close($dbc);
?>
</p>

<form>

<p>
<input type="button" value="Home Menu" onclick="window.location.href='http://localhost/HomeMenu.php'" />
</p>


</form>
</body>
</html>