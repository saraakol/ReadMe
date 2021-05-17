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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
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
                <img src="/img/logo.png" alt="" height="100" width="100" align="center">
                <div class="row">
                    <div class="col-6">
                    
                <br>
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
                <br>
                <form name="addBook" action="<?=site_url("Administrator/addBookSubmit")?>" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Book title">
                <br><br>
                <input type="text" name="authors" placeholder="Authors">
                <br>&nbsp;<br>&nbsp;
                <select name="genres[]" id="" multiple>
<!--                    <option value="" hidden>Genre</option>
                    <option value="">Romance</option>
                    <option value="">Sci-Fi</option>
                    <option value="">Drama</option>
                    <option value="">option 4</option>-->
                    <?php 
                        
                        foreach($genres as $genre)
                        {
                            echo "<option value={$genre->getIdg()}>{$genre->getName()}</option>";
                        }
                    ?>
                </select>
                </div>
                <div class="col-6">
                    <br>&nbsp;<br>&nbsp;
            <textarea name="synopsis" cols="20" rows="7" placeholder="add synopsis"></textarea>
            
            <br><br>
                </div>
            </div>
                
<!--                <button class="bigbutton">Add Book cover</button>-->
                    <label for="file-upload" class="custom-file-upload">
                        <i class="fa fa-cloud-upload"></i> Add Book cover
                      </label>
                      <input id="file-upload" name='img' type="file" accept="image/*" style="display:none;">
                <br><br>
                <input type="submit" value="Add">
                &nbsp;
                <a href="../Administrator/index"><input type="button" value="Cancel"></input>
                <br>&nbsp;<br>&nbsp;
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script>
   $('#file-upload').change(function() {
            console.log("a");
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
    </script>
</body>

</html>