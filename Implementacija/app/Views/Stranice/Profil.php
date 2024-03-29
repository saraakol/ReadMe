<?php
?>
        <div class="row ">
            
            <div class="col gradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>
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
                            echo "<div id='breakCilj' class='break-row'></div>";
                            echo "<div class='progress'>";
                            echo "  <input type='hidden' value='" . $brProcitanih . "'>";
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
                            <?php 
                            foreach ($nepretplaceni as $nepretplacen) {
                                echo "<option value='{$nepretplacen->getIdg()}'>{$nepretplacen->getName()}</option>";
                            }
                            ?>
                        </select>
                        <div class="break-row"></div>
                        <input type="hidden" name="idU" class="idu" value="<?= $korisnik->getIdu(); ?>">
                        <input class="margin-medium" type="submit" name="dodajZanr" value="Confirm">
                        <input class="prekiniZanr margin-medium" type="button" value="Cancel">
                    </form>
                    <form id="ukloniZanrForma" class="flex-centrirano" name="ukloniZanr" method="get" action=" <?= site_url("$controller/ukloniPretplatu"); ?>">
                        <select name="list" id="ukloniZanrLista">
                            <option value="disabled" selected disabled>Select genre</option>
                            <?php 
                            foreach ($pretplaceni as $pretplacen) {
                                echo "<option value='{$pretplacen->getIdg()}'>{$pretplacen->getName()}</option>";
                            }
                            ?>
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
                    <h3 style="padding-left: 30px;">My books</h3>
                    <br>

                    <br>
                        
                    <div class="col-12 " style="width:100%;">
                    <span style="font-size: 4vh;padding-left: 30px;">All (<?= sizeof($all);?>)<input type="checkbox" id="alllist" onclick="kliknutalisaall()" checked></span>
                    <span style="font-size: 4vh;padding-left: 30px;">Read (<?= sizeof($read);?>)<input type="checkbox" id="readlist" onclick="kliknutalistaread()"></span>
                    <span style="font-size: 4vh;padding-left: 30px;">Want to read (<?= sizeof($wantToRead);?>)<input type="checkbox" id="wantlist" onclick="kliknutalistawant()"></span> 
                    <span style="font-size: 4vh;padding-left: 30px;">Subscribed genres <input type="checkbox" id="subscribedlist" onclick="kliknutalistasubscribed()"></span>
                    <?php 
                    if ($controller == 'Administrator' || $controller == 'Privilegovani') {
                    echo '<span style="font-size: 4vh;padding-left: 30px;">Recommended list <input type="checkbox" id="recommendedlist" onclick="kliknutalistarecommended()"></span>';
                    }
                     ?>
                    </div>
                    <!--<div style="width:100%;">&nbsp;</div>-->
                    <br><br>
                    <div class="alllist" >
                        
                        <?php
                        $niz=array();
                        foreach ($all as $item) {
                            $niz[]=$item->getIdb()->getIdb();
                            echo '<figure class="figuree">';
                            if($item->getIdb()->getImage()!=null)
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/". $item->getIdb()->getIdb() .
                                    ".jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            else
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/no_photo.jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 4vh;'>".$item->getIdb()->getName()."</figcaption>");
                            echo '</figure>';
                        }
                        ?>
                        
                    </div>

                    <br>
                    
                    <div class="readlist" style="display: none;">
                        <?php
                        
                        foreach ($read as $item) {
                            echo '<figure class="figuree">';
                            if($item->getIdb()->getImage()!=null)
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/". $item->getIdb()->getIdb() .
                                    ".jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            else
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/no_photo.jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 4vh;'>".$item->getIdb()->getName()."</figcaption>");
                            echo '</figure>';
                        }
                       
                        
                        ?>
<!--                        <div class="breakfloat">&nbsp;</div>-->
                    </div>


                    <br>
                    <div class="wantlist" style="display: none;">

                        <?php   
                        
                        
                        foreach ($wantToRead as $item) {
                            echo '<figure class="figuree">';
                            if($item->getIdb()->getImage()!=null)
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/". $item->getIdb()->getIdb() .
                                    ".jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            else
                                echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<img src='/images/books/no_photo.jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                            echo anchor("$controller/prikaziKnjigu/".$item->getIdb()->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 4vh;'>".$item->getIdb()->getName()."</figcaption>");
                            echo '</figure>';
                        }
                        
                        ?>
                        
<!--                        <div class="breakfloat">&nbsp;</div>-->
                    </div>
                    <br>
                    <div class="subscribedlist" style="display: none;">

                        <?php
                        $flag=false;
                        $zanroviKorisnika = $korisnik->getGenres();                                                         //pretplaceni zanrovi korisnika
                        foreach ($knjige as $knjiga){
                            $zanroviKnjige = $knjiga->getGenres();
                            
                            foreach($zanroviKnjige as $zanrKnjige){
                                if($zanroviKorisnika->contains($zanrKnjige)){
                                    echo '<figure class="figuree">';
                                    if($knjiga->getImage()!=null)
                                        echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<img src='/images/books/". $knjiga->getIdb() .
                                            ".jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                                    else
                                        echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<img src='/images/books/no_photo.jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                                    echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<figcaption style='mmargin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 4vh;'>".$knjiga->getName()."</figcaption>");
                                    echo '</figure>';
                                    break;
                                }
                            }
                        }
//                        echo '<div class="breakfloat">&nbsp;</div>'; 
                        ?>
                    </div>
                    <?php
                    if ($controller == 'Administrator' || $controller == 'Privilegovani') {
                        echo '<div class="recommendedlist" style="display: none;">';

                            $num=0;
                            foreach ($knjige as $knjiga) {
                                $num++;
                                if(in_array($knjiga->getIdb(),$niz)==false && $num%2==0){
                                    echo '<figure class="figuree">';
                                    if($knjiga->getImage()!=null)
                                        echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<img src='/images/books/". $knjiga->getIdb() .
                                            ".jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                                    else
                                        echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<img src='/images/books/no_photo.jpg' style=' width: 200px;height:300px; margin-left: 4vh;'>");
                                    echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 4vh;'>".$knjiga->getName()."</figcaption>");
                                    echo '</figure>';
                                }
                            }
                        echo '</div>';
                    
                    }
                    ?>
                </div>   
            </div>
        </div>
                <?php 
            if (isset($poruka)) {
                echo '<div class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true" style="position:absolute;top:5%;right:42%;">';
                echo '  <div class="toast-header">';
                echo '      <strong class="mr-auto">Message</strong>';
                echo '      <small>Now</small>';
                echo '      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
                echo '          <span aria-hidden="true">&times;</span>';
                echo '      </button>';
                echo '  </div>';
                echo "  <div class='toast-body'>$poruka</div>";
                echo '</div>';
            }
        ?>
        
        <script>
            $(document).ready(function(){
                if ($('.toast')) {
                    $('.toast').toast('show');
                }
            });
        </script>

