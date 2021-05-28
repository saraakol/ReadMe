<?php
?>

        <div class="row ">
            
            <div class="col naopackegradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>
        <div class="row bio">

            <div class="col-lg-4 col-md-6 col-sm-12" style="text-align: center;">
                <img src="dovuci sliku" alt="" height="400" width="280">
                <br>&nbsp;<br>&nbsp;
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                &nbsp;4,0
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12" style="text-align: center;">
                <p class="booktitle"><font class="booktitle"><?= $knjiga->getName(); ?> </font></p>
                
                <p class="bookbio">
                    <font class="bookauthor"><?= $knjiga->getName(); ?>  </font>
            <!-- ubaciti zanrove -->         <font class="bookgenre"><?= count($knjiga->getGenres()); ?></font>   <!-- ubaciti zanrove -->
                </p>

                <p class="booksynop" style="text-align: justify;"><font style="font-size: 15px;"> <?= $knjiga->getDescription(); ?>  </font></p>


            </div>
            <div class="col-lg-3">&nbsp;</div>

        </div>

        
        <div class="row">
            <?php 
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    echo '<div class="col-lg-4 col-md-12 col-sm-12 ratearea" style="text-align: center;">';
                    echo "  <form name='formazaciljkomentare' method='' action=''>";
                    echo "<br><p class='rate' name='rate'><font style='font-size: 15px;'>Rate</font></p>";
                    echo "<p class='review' name='review'><font style='font-size: 15px;'><a href='/{$controller}/addReview'>Add review</a></font></p>";
                    if($controller == 'Administrator' || $controller == 'Privilegovani') { 
                    echo " <p class='quote' name='quote'><font style='font-size: 15px;'><a href='/{$controller}/addQuote'>Add quote</a></font></p>";
                    }
                    echo "  </form>";
                    
                    echo "</div>";
                       
                     
                                              
                }
            ?>
            <?php 
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    echo '<div class="col-lg-2 col-md-6 col-sm-12" style="text-align: center; margin-top: 2vh;">';
                    echo "  <form name='dodavanjenalistu' method='' action=''>";
                    echo "<a href=''><button  class='addtolist'>Add to Want to Read</button></a> ";
                    echo "  </form>";
                    echo "</div>";
                       
                     
                                              
                }
            ?>
             <?php 
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12" style="text-align: center; margin-top: 2vh;"">';
                    echo "  <form name='dodavanjenaprocitanou' method='' action=''>";
                    echo "<a href=''><button  class='addtolist'>Add to Read</button></a> ";
                    echo "  </form>";
                    echo "</div>";
                       
                     
                                              
                }
            ?>
            
            
            
            <br>&nbsp;
            <div class="col-lg-3">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col gradient"><br>&nbsp;</div>
        </div>





        
       
