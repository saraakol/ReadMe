<?php
?>

        <div class="row">
            <div class="col" style="background-color: #ffeedf;">
                <br>
                <p style="font-size: 4vh;"><?= $zahtev; ?> </p>
                <hr>
            </div>
        </div>
        
        <?php
        foreach ($korisnici as $korisnik) {
            echo "<div class='row buttons'>";
            echo "  <div class='col-lg-3 col-md-6' style='background-color: #ffeedf; text-align: center;'>";
            echo "      <a href=''><p><font>{$korisnik->getUsername()}</font></p></a>";
            echo "  </div>";
            echo "  <div class='col-lg-5 col-md-1' style='background-color: #ffeedf;'>&nbsp;</div>";
            echo "  <div class='col-lg-4 col-md-5' style='background-color: #ffeedf;text-align: center;padding-bottom: 1vh;'>";
            echo "      <form name='potvrdiRegistraciju' method='get' action='" . site_url("$controller/accept" . "$zahtev") . "'>";
            echo "          <input type='hidden' name='username' value='" . $korisnik->getUsername() . "'>";
            echo "          <input type='submit' name='potvrdiRegistraciju' value='Accept'>";
            echo "      </form>";
            echo "      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "      <form name='odbijRegistraciju' method='get' action='" . site_url("$controller/decline" . "$zahtev") . "'>";
            echo "          <input type='hidden' name='username' value='" . $korisnik->getUsername() . "'>";
            echo "          <input type='submit' name='odbijRegistraciju' value='Decline'>";
            echo "      </form>";            
            echo "  </div>";
            echo "  <br>";
            echo "</div>";
            echo "<div class='row'>";
            echo "  <div class='col' style='background-color: #ffeedf'>";
            echo "  <hr>";
            echo "  </div>";
            echo "</div>";
        }
        ?>
        