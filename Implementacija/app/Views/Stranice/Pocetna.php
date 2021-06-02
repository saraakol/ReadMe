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


            <div class="row">
                <div class="col knjigepozadina">
                    <div class="selects">
                        <form method="post" action="<?=site_url("/{$controller}/sort")?>">
                            <select required class="select" name="sort" onchange="" style="width: 150px;">

                                <option value=""
                                        hidden
                                >Sort</option>

                                <!-- normal options -->
                                <option class="option" value="A-Z">A-Z</option>
                                <option class="option" value="Z-A">Z-A</option>
                            </select>
                            <input class="margin-medium" type="submit" name="submit" value="Confirm sort" style="width: 150px;">
                        </form>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    <form method="post" action="<?=site_url("/{$controller}/filter")?>">
                        <select required class="select" name="filter" style="width: 150px;">

                            <option value=""
                                    hidden
                            >Filter</option>
                            
                            <?php
                            foreach($genres as $genre){
                                echo "<option class='option' value='". $genre->getName()."'>".$genre->getName()."</option>";
                            }
                            ;?>
                        </select>
                        <input class="margin-medium" type="submit" name="submit" value="Confirm filter" style="width: 150px;">
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
    <div class='row book knjigepozadina '>
             
<?php
    if($noveKnjige!=null && $filter!=null){             //postoji rezultat filtriranja
        foreach ($noveKnjige as $item) {
//            echo "<div class='row book'>";
//              echo  "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
//              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
//              echo       anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", "<img src='/images/books/".$knjiga->getIdb() .".jpg' alt='' >", ['class'=>'nav-link']);
//              echo  "</div>";
//              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
//               echo    " <p class='floatleft'>";
//               echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", $knjiga->getName(), ['class'=>'nav-link']);
//               echo "<br>". $knjiga->getAuthors() ."</p> ";
//               echo "</div>";
//               echo "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
//            echo "</div> ";   
             echo '<figure class="figure">';
              echo anchor("$controller/prikaziKnjigu/".$item->getIdb()."","<img src='/images/books/". $item->getIdb() .
                 ".jpg' style=' width: 200px;height:300px; margin-left: 6vh;'>");
              echo anchor("$controller/prikaziKnjigu/".$item->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 6vh;padding-bottom:5vh;'>".$item->getName()."</figcaption>");
            echo '</figure>';
        }
    }else if($noveKnjige==null && $filter!=null){       //rezultat filtriranja prazna lista
        echo "<div class='row book'>";
        echo "<h2>No book for that filter</h2>";
        echo "</div> "; 
    }else{
        foreach ($knjige as $item) {                  //nema filtriranja
//            echo "<div class='row book'>";
//              echo  "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
//              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
//              echo       anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", "<img src='/images/books/".$knjiga->getIdb() .".jpg' alt='' >", ['class'=>'nav-link']);
//              echo  "</div>";
//              echo  "<div class='col-md-2 col-ld-2 col-sm-12'>";
//               echo    " <p class='floatleft'>";
//               echo anchor("$controller/prikaziKnjigu/".$knjiga->getIdb()."", $knjiga->getName(), ['class'=>'nav-link']);
//               echo "<br>". $knjiga->getAuthors() ."</p> ";
//               echo "</div>";
//               echo "<div class='col-md-4 col-ld-4'>&nbsp;</div>";
//            echo "</div> "; 
           
                            echo '<figure class="figure">';
                            echo anchor("$controller/prikaziKnjigu/".$item->getIdb()."","<img src='/images/books/". $item->getIdb() .
                                    ".jpg' style=' width: 200px;height:300px; margin-left: 6vh;'>");
                            echo anchor("$controller/prikaziKnjigu/".$item->getIdb()."","<figcaption style='margin-top: 2vh;width: 200px;padding-right:2vh; margin-left: 6vh;padding-bottom:5vh;'>".$item->getName()."</figcaption>");
                            echo '</figure>';
                        
                 
        }  
    }
?>
        
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