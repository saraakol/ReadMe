<?php
?>

<div class="row ">
            
            <div class="col naopackegradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>
<div class="row ">
            
            <div class="col drugired belapozadina">
                <p class="naslov2">Today a reader. Tomorrow a leader.</p>
            </div>
        </div>
<div class="row ">
            
            <div class="col gradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>

<div class="knjigepozadina">
            <div class="row">
                <div class="col">
                    <div class="selects">
                        <form method="post" action=" <?php
                    if(session()->get("korisnik")!=null)
                       echo site_url("Korisnik/sort");
                    else echo site_url("Gost/sort");?>">
                            <select required class="select" name="sort" onchange="">

                                <option value=""
                                        hidden
                                >Sort</option>

                                <!-- normal options -->
                                <option class="option" value="A-Z">A-Z</option>
                                <option class="option" value="Z-A">Z-A</option>
                            </select>
                            <input class="margin-medium" type="submit" name="submit" value="Confirm sort">
                        </form>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <form method="post" action=" <?php
                    if(session()->get("korisnik")!=null)
                       echo site_url("Korisnik/filter");
                    else echo site_url("Gost/filter");?>">
                        <select required class="select" name="filter">

                            <option value=""
                                    hidden
                            >Filter</option>
                            
                            <?php
                            foreach($genres as $genre){
                                echo "<option class='option' value='". $genre->getName()."'>".$genre->getName()."</option>";
                            }
                            ;?>
                        </select>
                        <input class="margin-medium" type="submit" name="submit" value="Confirm filter">
                    </form>
                    <br>
                    <br>
                    <p class="newreleases">New releases</p>
                    <!--   -->
                    <br>
                    <br>
                    </div>
                </div>
            </div>
            
<?php

    foreach ($knjige as $knjiga) {
        echo "<div class='row book'>";
              echo  "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
              echo       anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", "<img src='/images/books/".$knjiga->getIdb() .".jpg' alt='' >", ['class'=>'nav-link']);
              echo  "</div>";
              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
               echo    " <p class='floatleft'>";
               echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", $knjiga->getName(), ['class'=>'nav-link']);
               echo "<br>". $knjiga->getAuthors() ."</p> ";
               echo "</div>";
               echo "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
            echo "</div> ";   
    }
?>
    <!-- Ovo ispod (ukljucujuci javascript deo) treba dodati na svakoj stranici gde treba da se prikaze modal -->
        <!-- U kontroleru koji prikazuje stranicu postaviti promenjivu poruka da ima vrednost teksta greske/uspeha -->
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
            

</div>
<script>
            $(document).ready(function(){
                if ($('.toast')) {
                    $('.toast').toast('show');
                }
            });
        </script>