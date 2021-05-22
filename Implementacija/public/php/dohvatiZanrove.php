<?php

$idU = $_GET['idU'];
$type = $_GET['type'];

$mysql = new mysqli('localhost', 'root', '', 'readme', '3308');
$sql = null;

if ($type == 'subscribed') {
    $sql = "SELECT g.IdG as Id, g.Name as Name FROM genre g JOIN subscription s ON g.IdG = s.IdG "
            . "WHERE s.IdU=" . $idU;
} else {
    $sql = "SELECT g.IdG as Id, g.Name as Name FROM genre g WHERE g.IdG NOT IN ("
            . " SELECT s.IdG FROM subscription s WHERE s.IdU = ". $idU . ")";
}

$result = $mysql->query($sql);

while ($row = $result->fetch_object()) {
    echo "$row->Id-$row->Name;";
}