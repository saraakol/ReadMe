<?php
?>

        <div class="row">
            <div class="col" style="background-color: #ffeedf;">
                <br>
                <p style="font-size: 4vh;">Registrations </p>
                <hr>
            </div>
        </div>
        <?php
        foreach ($registracije as $registracija) {
            echo "
                <div class='row buttons'>
                    <div class='col-lg-3 col-md-6' style='background-color: #ffeedf; text-align: center;'>
                        <a href=''><p><font>$registracija->Username</font></p></a>           
                    </div>
                    <div class='col-lg-5 col-md-1' style='background-color: #ffeedf;'>&nbsp;</div>
                    <div class='col-lg-4 col-md-5' style='background-color: #ffeedf;text-align: center;padding-bottom: 1vh;' >
                        <button>Accept</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button>Decline</button>       
                    </div>
                    <br>
                </div>
                <div class='row'>
                    <div class='col' style='background-color: #ffeedf'>
                    <hr>
                    </div>
                </div>";
        }
        ?>
