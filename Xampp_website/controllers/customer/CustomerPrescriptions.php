

<html>
<head>
<title>Prescription List by Customer</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Get a connection for the database
require_once('../../mysqli_connect.php'); //←--this assumes you put mysqli in xampp and not htdocs
// Create a query for the database
$query = 'SELECT  customer.Customer_ID, customer.Customer_Name, Pre.Prescription_ID, Doc.Doctor_Name, med.Med_Name, Pre.Refill_Amount, Pre.Date_Writen
FROM prescription as Pre 
join doctor as Doc on Doc.Doctor_ID = Pre.Doctor_ID
JOIN customer on customer.Customer_ID = Pre.Customer_ID
JOIN med on med.Med_ID = Pre.Med_ID 
Order by customer.Customer_ID';
// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);
// If the query executed properly proceed
if($response){
echo '<table align="left"
cellspacing="5" cellpadding="8">
<tr><td align="left"><b>Customer_ID</b></td>
<td align="left"><b>Customer_Name</b></td>
<td align="left"><b>Prescription_ID</b></td>
<td align="left"><b>Doctor_Name</b></td>
<td align="left"><b>Med_Name</b></td>
<td align="left"><b>Refill_Amount</b></td>
<td align="left"><b>Date_Writen</b></td></tr>';
// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){
echo '<tr><td align="left">' . 

$row['Customer_ID'] . '</td><td align="left">' .
$row['Customer_Name'] . '</td><td align="left">' .
$row['Prescription_ID'] . '</td><td align="left">' .
$row['Doctor_Name'] . '</td><td align="left">' .
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


<form>



</form>
</body>
</html>