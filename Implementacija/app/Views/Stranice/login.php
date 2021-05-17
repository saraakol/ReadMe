<?php
redirect()->to(site_url("Gost/index"));
?>
    
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadMe</title>
    <link rel = "icon" href = 
        "logo.png" 
        type = "image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' type="text/css" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
</head>

<body class="login">
    <div class="container-fluid ">
        <div class="row loginrow2">
            <div class="col ">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>
        <div class="row loginrow2">
            <div class="col-md-4"></div>
            <div class="col-md-4 loginbox">
                <br>&nbsp;
                <div class="row">
                    <div class="col">
                        &nbsp;
                    </div>
                    <div class="col">
                        <img src="/img/logo.png" alt="" height="50" width="50" align="bottom">
                    </div>
                    <div class="col">
                        <p1>Login</p1><br>&nbsp;
                    </div>
                    <div class="col">
                        &nbsp;
                    </div>
                </div>


                <p>Welcome back!</p>
                <font color="red">
                <?php
                if(isset($poruka))
                {
                    $errors=$poruka["errors"];
                    foreach($errors as $error)
                    {
                        echo $error;
                        echo "</br>";
                        
                    }
                }
                
                ?>
                <form name="login" action="<?=site_url("Gost/loginSubmit")?>" method="POST">
                <input type="text" name="username" placeholder="username">
                <br><br>
                <input type="password" name="password" placeholder="password">
                <br><br>
                <input type="submit" value="Continue">
<!--                </form>-->
                &nbsp;
                
                <a href="../Gost/index"><input type="button" value="Cancel"></input></a>
                <br>&nbsp;<br>&nbsp;
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>