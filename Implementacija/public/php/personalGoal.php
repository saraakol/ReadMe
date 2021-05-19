<?php
/*
use App\Models\Entities;

$doctrine= \App\Config\Services::doctrine();
$username = $_GET['username'];

$user = $doctrine->em->getRepository(Entities\User::class)->findOneBy(['username'=>$username]);
$readNumber = $doctrine->em->getRepository(Entities\User::class)->dohvatiBrojProcitanihKnjiga($user->getIdu());
$percentage = 100 * $readNumber / $user->getPersonalGoal();

echo "$percentage";
 */

$username = $_GET['username'];

$con = mysqli_connect('localhost', 'root', '', 'readme', 3308);
$sql = "SELECT COUNT(b.IdB) as broj FROM user u JOIN userbooks b ON u.IdU = b.IdU WHERE u.Username='" . $username . "' AND b.Type='read' GROUP BY u.IdU";
$result = mysqli_query($con, $sql);

if ($result->num_rows == 0)
    $result = 0;
else 
    $result = $result->fetch_object()->broj; 

echo "$result";