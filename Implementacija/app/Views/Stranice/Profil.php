<?php
?>

        <div class="row profil">
            <div class="col-4 flex-centrirano">
                <?php 
                if ($korisnik->getImage() == null) {
                    echo '<img src="\images\users\no_photo.jpg" class="img-thumbnail" alt="No photo">';
                } else {
                    echo '<img src="\images\users\\' . $korisnik->getIdu() . '.jpg" class="img-thumbnail" alt="No photo">';
                }
                ?>
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
                    if ($user_type == 'administrator' || $user_type == 'privileged_user') {
                        if ($korisnik->getPersonalGoal() == null) {
                            echo "<button id='dodajCiljDugme'>Add Goal</button>";
                            echo "<div id='unosCilja'>";
                            echo "  <h3>Insert goal:</h3>";
                            echo "  <form name='dodajCilj' method='get' action='" . site_url("Privilegovani/dodajCilj") . "'>";
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
                    <form id="dodajZanrForma" class="flex-centrirano" name="dodajZanr" method="get" action="<?= site_url("Korisnik/dodajPretplatu"); ?>">
                        <select name="list" id="dodajZanrLista">
                            <option value="disabled" selected disabled>Select genre</option>
                        </select>
                        <div class="break-row"></div>
                        <input type="hidden" name="idU" class="idu" value="<?= $korisnik->getIdu(); ?>">
                        <input class="margin-medium" type="submit" name="dodajZanr" value="Confirm">
                        <input class="prekiniZanr margin-medium" type="button" value="Cancel">
                    </form>
                    <form id="ukloniZanrForma" class="flex-centrirano" name="ukloniZanr" method="get" action=" <?= site_url("Korisnik/ukloniPretplatu"); ?>">
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
            
            <div class="row">
                <div class="col" style="background-color: #ffeedf">
                    <h3>My books</h3>
                    <br>
                    
                <p style="font-size: 4vh;">All <input type="checkbox" name="" id="alllist" onclick="kliknutalisaall()" checked></p>                <!--dinamicki dodati i broj knjiga--> 
                <div class="alllist">
                    <?php
                    foreach ($all as $item) {
                        echo '<figure class="figuree">';
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='". $item->getIdb()->getImage() .
                                "' style=' width: 200px; margin-left: 3vh;'>");
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;padding-right:2vh;'>".$item->getIdb()->getName()."</figcaption>");
                        echo '</figure>';
                    }
                    ?>
                </div>
                     <br>
                <p style="font-size: 4vh;">Read <input type="checkbox" name="" id="readlist" onclick="kliknutalistaread()"></p>                <!--dinamicki dodati i broj knjiga--> 
                <div class="readlist" style="display: none;">
                    <?php
                    foreach ($read as $item) {
                        echo '<figure class="figuree">';
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='". $item->getIdb()->getImage() .
                                "' style=' width: 200px; margin-left: 3vh;'>");
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;padding-right:2vh;'>".$item->getIdb()->getName()."</figcaption>");
                        echo '</figure>';
                    }
                    ?>
                </div>
                  
                  
                <br>
                <p style="font-size: 4vh;">Want to read <input type="checkbox"  name="" id="wantlist" onclick="kliknutalistawant()"></p>                <!--dinamicki dodati i broj knjiga--> 
                <div class="wantlist" style="display: none;">
                    
                    <?php
                    foreach ($wantToRead as $item) {
                        echo '<figure class="figuree">';
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='". $item->getIdb()->getImage() .
                                "' style=' width: 200px; margin-left: 3vh;'>");
                        echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;padding-right:2vh;'>".$item->getIdb()->getName()."</figcaption>");
                        echo '</figure>'; 
                    }   
                    ?>
                  
                </div>
                        
                </div>
                
                
             
                
            </div>
        </div>
        

