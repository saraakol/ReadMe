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
                        <select required class="select">
                           
                            <option value=""
                                    hidden
                            >Sort</option>
                        
                            <!-- normal options -->
                            <option class="option" value="1">Name A-Z</option>
                            <option class="option" value="2">Name Z-A</option>
                            <option class="option" value="3">Option 3</option>
                            <option class="option" value="4">Option 4</option>
                            <option class="option" value="5">Option 5</option>
                          </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select required class="select">
                           
                        <option value=""
                                hidden
                        >Filter</option>
                    
                        <!-- normal options -->
                        <option class="option" value="1">Sci-Fi</option>
                        <option class="option" value="2">Drama</option>
                        <option class="option" value="3">Option 3</option>
                        <option class="option" value="4">Option 4</option>
                        <option class="option" value="5">Option 5</option>
                      </select>
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