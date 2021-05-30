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
                        <form method="post" action="<?=site_url("/{$controller}/sort")?>">
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
                    
                    <form method="post" action="<?=site_url("/{$controller}/filter")?>">
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
    if($noveKnjige!=null){
        foreach ($noveKnjige as $knjiga) {
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
    }else{
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
    }
?>
            

</div>