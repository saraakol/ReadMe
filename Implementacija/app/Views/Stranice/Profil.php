<?php
?>

        <div class="row profil">
            <div class="col-4 flex-centrirano">
                <img src="\img\drazen.jpg" class="img-thumbnail" alt="No photo">
            </div>
            <div class="col-4 flex-centrirano">
                <h1><?= $korisnik->getFirstname() . " " . $korisnik->getLastname(); ?></h1>
                <div class="break-row"></div>
                <h2><?= $korisnik->getUsername(); ?></h2>
                <div class="break-row"></div>
                <p><i>
                    <?php
                        if ($korisnik->getType() == 'administrator')
                            echo 'Administrator';
                        else if ($korisnik->getType() == 'regular_user')
                            echo 'Regular user';
                        else
                            echo 'Privileged user';
                    ?>
                </i></p>
            </div>
            <div class="col-4 flex-centrirano">
                <div class="cilj">
                    <?php 
                    if ($controller == 'Administrator' || $controller == 'Privilegovani') {
                        if ($korisnik->getPersonalGoal() == null) {
                            echo "<button id='dodajCiljDugme'>Add Goal</button>";
                            echo "<div id='unosCilja'>";
                            echo "  <h3>Insert goal:</h3>";
                            echo "  <form name='dodajCilj' method='get' action='" . site_url("$controller/dodajCilj") . "'>";
                            echo "      <input type='hidden' name='username' value='" . $korisnik->getUsername() . "'>";
                            echo "      <input type='number' name='brojKnjiga'><br><br>";
                            echo "      <input type='submit' id='acceptCilj' name='dodajCilj' value='Accept'>";
                            echo "      <input type='button' id='prekiniCilj' value='Cancel'>";
                            echo "  </form>";
                            echo "</div>";
                        } else {
                            //Progress bar
                            echo "<h2 id='brojProcitanihCilj'></h2>";
                            echo "<div class='break-row'></div>";
                            echo "<div class='progress'>";
                            //Ajax ce popuniti progress bar informacijama
                            echo "  <input id='progressUsername' type='hidden' value='" . $korisnik->getUsername() . "'>";
                            echo "  <input id='progressPersonalGoal' type='hidden' value='" . $korisnik->getPersonalGoal() . "'>";
                            echo "  <div id='progressBarDiv' class='progress-bar progress-bar-striped bg-danger progress-bar-animated'>";
                            echo "      <b id='progressBarText'></b>";
                            echo "  </div>";
                            echo "</div>";
                        }                            
                    }
                    ?>
                </div>
                <div class="break-row"></div>
                <div class="mojiZanrovi flex-centrirano">
                    <button class="margin-medium" id="dodajZanrDugme">Add genre</button>
                    <button class="margin-medium" id="ukloniZanrDugme">Remove genre</button>
                    <form id="dodajZanrForma" class="flex-centrirano" name="dodajZanr" method="get" action="<?= site_url("$controller/dodajPretplatu"); ?>">
                        <select name="list" id="dodajZanrLista">
                            <option value="disabled" selected disabled>Select genre</option>
                        </select>
                        <div class="break-row"></div>
                        <input type="hidden" name="idU" class="idu" value="<?= $korisnik->getIdu(); ?>">
                        <input class="margin-medium" type="submit" name="dodajZanr" value="Confirm">
                        <input class="prekiniZanr margin-medium" type="button" value="Cancel">
                    </form>
                    <form id="ukloniZanrForma" class="flex-centrirano" name="ukloniZanr" method="get" action="">
                        <select name="list" id="ukloniZanrLista">
                            <option value="disabled" selected disabled>Select genre</option>
                        </select>
                        <div class="break-row"></div>
                        <input type="hidden" name="idU" class="idu" value="<?= $korisnik->getIdu(); ?>">
                        <input class="margin-medium" type="submit" name="ukloniZanr" value="Confirm">
                        <input class="prekiniZanr margin-medium" type="button" value="Cancel">
                    </form>
                </div>
            </div>
        </div>
        

