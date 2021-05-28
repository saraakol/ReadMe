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
                            <select required class="select" name="sort">

                                <option value=""
                                        hidden
                                >Sort</option>

                                <!-- normal options -->
                                <option class="option" value="A-Z">A-Z</option>
                                <option class="option" value="Z-A">Z-A</option>
                                <option class="option" value="5">Option 5</option>
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

                            <!-- normal options -->
                            <option class="option" value="Sci-Fi">Sci-Fi</option>
                            <option class="option" value="Drama">Drama</option>
                            <option class="option" value="Romance">Romance</option>
                            <option class="option" value="Crime">Crime</option>
                            <option class="option" value="">Option 5</option>
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
              echo       anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", "<img src='".$knjiga->getImage() ."' alt='' >", ['class'=>'nav-link']);
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
            

</div>