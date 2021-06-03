<?php
?>
        <div class="row ">
            
            <div class="col gradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>
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
            echo "  <div class='col-lg-3 col-md-6 zahtev' style='background-color: #ffeedf;'>";
            if ($korisnik->getImage() == null) {
                echo '  <img src="\images\users\no_photo.jpg" class="mr-3" alt="No photo">';
            } else {
                echo '  <img src="\images\users\\' . $korisnik->getIdu() . '.jpg" class="mr-3" alt="No photo">';
            }
            echo        "<h3>{$korisnik->getUsername()}</h3>";
            echo "  </div>";
            echo "  <div class='col-lg-5 col-md-1' style='background-color: #ffeedf;'>&nbsp;</div>";
            echo "  <div class='col-lg-4 col-md-5' style='background-color: #ffeedf;text-align: center;padding-bottom: 1vh;'>";
            echo "      <form>";
            echo "          <input type='hidden' name='username' value='" . site_url("Administrator/accept" . "$zahtev" . "?username=" . "{$korisnik->getUsername()}") . "'>";
            echo "          <input class='zahtev-forma acceptZahtev' type='submit' value='Accept'>";
            echo "      </form>";
            echo "      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if ($zahtev != 'Upgrades') {
                echo "      <form>";
                echo "          <input type='hidden' name='username' value='" . site_url("Administrator/decline" . "$zahtev" . "?username=" . "{$korisnik->getUsername()}") . "'>";
                echo "          <input type='submit' class='declineZahtev' value='Decline'>";
                echo "      </form>";   
            }            
            echo "  </div>";
            echo "  <br>";
            echo "  <div class='col' style='background-color: #ffeedf'><hr></div>";
            echo "</div>";
        }
        ?>
        
        <div class="toast toast-zahtevi" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true" style="position:absolute;top:30%;right:42%;">
            <div class="toast-header">
              <strong class="mr-auto">Message</strong>
              <small>Now</small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body">
              Operation successful!
            </div>
        </div>