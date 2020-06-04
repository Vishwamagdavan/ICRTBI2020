<?php

//$con = mysqli_connect("localhost", "u987684220_fdp", "admin@stjose", "u987684220_fdp");
$con = mysqli_connect("localhost", "root", "", "epushserver");
$query_2 = "SELECT * FROM icrtbi_certificate,icrtbi_register WHERE icrtbi_register.paper_id=icrtbi_certificate.paper_id AND  icrtbi_register.payment_id="ICRTBI20202052421264""; //Query for Fetching the Certificates details
$result = mysqli_query($con, $query_2);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));}
while ($row1 = mysqli_fetch_array($result)) {
    echo "<td>" . $row1['certi_names'] . "</td>";
    echo "<td>" . $row1['certi_inst'] . "</td>";
    echo "<tr>";
}
?>