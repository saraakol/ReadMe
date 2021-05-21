<?php

$username = $_GET['username'];

$con = mysqli_connect('localhost', 'root', '', 'readme', 3308);
$sql = "SELECT COUNT(b.IdB) as broj FROM user u JOIN userbooks b ON u.IdU = b.IdU WHERE u.Username='" . $username . "' AND b.Type='read' GROUP BY u.IdU";
$result = mysqli_query($con, $sql);

if ($result->num_rows == 0)
    $result = 0;
else 
    $result = $result->fetch_object()->broj; 

echo "$result";