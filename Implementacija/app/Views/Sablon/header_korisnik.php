<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ReadMe</title>
    <link rel = "icon" href = "/img/logo.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/skripta1.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 header">
                <div class="">           
                    <div class="col-md-12">
                        <a href="/Korisnik/logout"><button class="logoutbutton">Logout</button></a>
                    </div>
                    <a href="<?=site_url("/")?>">
                        <img src="/img/logo.png" alt="Logo">
                    </a>
                    <br>&nbsp;
		</div>
            </div>
	</div>
        <div class="row">
            <div class="col-12 natpis">
		<div class="">
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
                            <?= anchor("$controller/", "Browse", ['class'=>'nav-link']) ?> &nbsp;&nbsp;
                        </li>
                        <li class="nav-item">
                            <?= anchor("$controller/prikaziProfil", "My Profile", ['class'=>'nav-link']) ?> &nbsp;&nbsp;
                        </li>
                        <?php
                        if ($controller == 'Administrator') {
                            echo anchor("Administrator/prikaziRegistracije", "Registrations", ['class'=>'nav-link']) . "&nbsp;&nbsp;";
                            echo anchor("Administrator/prikaziPrijave", "Reports", ['class'=>'nav-link']) . "&nbsp;&nbsp;";
                            echo anchor("Administrator/prikaziUnapredjenja", "Upgrades", ['class'=>'nav-link']) .  "&nbsp;&nbsp;";
                            echo '<a class="nav-link" href="/Administrator/addBook">Add Book &nbsp;&nbsp;</a>';
                        }
                        ?>
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