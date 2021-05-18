<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ReadMe</title>
    <link rel = "icon" href = 
        "/img/logo.png" 
        type = "image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="header">           
                    <div class="col-md-12">
                        <a href="/Administrator/logout"><button class="logoutbutton">Logout</button></a>
                    </div>
                    <img src="/img/logo.png" alt="Logo">
                    <br>&nbsp;
		</div>
            </div>
	</div>
        <div class="row">
            <div class="col-12">
		<div class="natpis">
                    <p class="naslov"> ReadMe</p>
                    <p class="ispodnaslova"> Gateway to Getaway</p>
		</div>
            </div>
	</div>
         <div class="row">
            <div class="col-12">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
                <nav class="navbar navbar-expand-sm justify-content-center"">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Browse &nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="MyBooks.html">My Books &nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <?= anchor("Administrator/prikaziRegistracije", "Registrations", ['class'=>'nav-link']) ?> &nbsp;&nbsp;
                        </li>
                        <li class="nav-item">
                            <?= anchor("Administrator/prikaziPrijave", "Reports", ['class'=>'nav-link']) ?> &nbsp;&nbsp;
                        </li>
                        <li class="nav-item">
                            <?= anchor("Administrator/prikaziUnapredjenja", "Upgrades", ['class'=>'nav-link']) ?> &nbsp;&nbsp;
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Administrator/addBook">Add Book &nbsp;&nbsp;</a>
                        </li>
                    </ul>
                </nav>
                <br>&nbsp;
            </div>
        </div>
        <div class="row">  
            <div class="col gradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>