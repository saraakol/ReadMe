
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    
    <script src="js/skripta.js"></script>
    
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
                <img src="\img\logo.png" alt="" height="100" width="100" align="center">
                <br><br>
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
                </font>
                <form name="register" action="<?=site_url("/{$controller}/registerAddRate")?>" method="POST" enctype="multipart/form-data">

                    <h5>Enter rate from 1 to 5</h5>

                        
                    <textarea name="rate"></textarea>
                    <input type="hidden" name="hiddenBook" value="<?=$bookId?>">

                    <br><br>
<!--                    <label for="img" class="custom-file-upload">
                         <i class="fa fa-cloud-upload"></i> Upload Image
                    </label>
                    <input type="file" id="img" name="img" accept="image/*">-->

                    
                    <br><br>
                    <input type="submit" data-toggle="modal" data-target="#exampleModal" value="Continue"></input>

                    
                    &nbsp;
                    <a href="<?=site_url("/{$controller}/prikaziKnjigu/{$bookId}")?>"><input type="button" value="Cancel"></input></a>
                    <!--<a href="<?=$referer?>"><input type="button" value="Cancel"></input></a>-->
                    <br>&nbsp;<br>&nbsp;
                    

                </form>
                            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script>
   $('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
    </script>
</body>

</html>