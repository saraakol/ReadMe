<?php
?>

<!--        <div class="row ">
            
            <div class="col naopackegradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>-->
        <div class="row bio">

            <div class="col-lg-4 col-md-6 col-sm-12" style="text-align: center;">
                <?php 
                if ($knjiga->getImage() == null) {
                    echo '<img src="\images\books\no_photo.jpg" class="img-thumbnail knjigaslika" alt="No photo">';
                } else {
                    echo '<img src="\images\books\\' . $knjiga->getIdb() . '.jpg" class="img-thumbnail knjigaslika" alt="Photo">';
                }
                ?>
                <!--<img src="/images/books/<?= $knjiga->getIdb(); ?>.jpg" alt="" height="400" width="280">-->
                <br>&nbsp;<br>&nbsp;
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <?php
                $numOfRates = sizeof($knjiga->getRates());
                if($numOfRates!=0){
                    $num=0;
                    $numOfRates=0;
                    foreach($knjiga->getRates() as $rate){
                        if($rate->getIdu()->getType()=="privileged_user" || $rate->getIdu()->getType()=="administrator"){
                            $num+=$rate->getRate()*1.5;
                            $numOfRates+=1.5;
                        }else{
                            $num+=$rate->getRate();
                            $numOfRates++;
                        }
                    }
                    $num=$num/$numOfRates;
                    $num= number_format($num,2);
                    echo "<h4>Rate: $num</h4>";
                }else{
                    echo "No rates yet";
                };
                ?>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12" style="text-align: center;">
                <p class="booktitle"><font class="booktitle"><?= $knjiga->getName(); ?> </font></p>
                
                <p class="bookbio">
                    <font class="bookauthor"><?= $knjiga->getAuthors(); ?>  </font>
            <!-- ubaciti zanrove -->         <font class="bookgenre"><?= implode(', ', $zanrovi); ?></font>   <!-- ubaciti zanrove -->
                </p>

                <p class="booksynop" style="text-align: justify;"><font style="font-size: 15px;"> <?= $knjiga->getDescription(); ?>  </font></p>


            </div>
            <div class="col-lg-3">&nbsp;</div>

        </div>
        

<br>
<br>
        <div class="row">  
            <?php 
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    
                    echo '<div class="col-lg-4 col-md-12 col-sm-12 ratearea" style="text-align: center;">';
                    echo "  <form name='formazaciljkomentare' method='' action=''>";
                    /*
                    $rates=session()->get('korisnik')->getRates();
                    $flag=false;
                    foreach($rates as $rate){
                        if($rate->getIdb()->getIdb()==$knjiga->getIdb()){
                            echo "<p class='review' name='review'><font style='font-size: 15px;'>Rated</font></p>";
                            $flag=true;
                            echo "usao";
                            break;
                        }
                    }
                    if($flag==false){
                        echo "<p class='review' name='review'><font style='font-size: 15px;'><a href='/{$controller}/addRate/{$knjiga->getIdb()}'>Add rate</a></font></p>";
                    }
                    */
                    $rates=$knjiga->getRates();
                    $flag=false;
                    $korisnikId=session()->get('korisnik')->getIdu();
                    foreach($rates as $r){
                        if($r->getIdu()->getIdu()==$korisnikId){
                            $flag=true;
                            break;
                        }
                    }
                    if($flag==true){
                        echo "<p class='review' name='review'><font style='font-size: 15px;'>Rated</font></p>";
                    }else{
                        echo "<p class='review' name='review'><font style='font-size: 15px;'><a href='/{$controller}/addRate/{$knjiga->getIdb()}'>Add rate</a></font></p>";
                    }
                    /*
                    $flag=false;
                    $korisnikId=session()->get('korisnik')->getIdu();
                    foreach($rates as $rate){
                        if($rate->getIdu().getIdu()==$korisnikId){
                            $flag=true;
                        }
                    }
                    if($flag==true){
                        echo "<p class='review' name='review'><font style='font-size: 15px;'>Rated</font></p>";
                    }else{
                        echo "<p class='review' name='review'><font style='font-size: 15px;'><a href='/{$controller}/addRate/{$knjiga->getIdb()}'>Add rate</a></font></p>";
                    }
                    */
                    echo "<p class='review' name='review'><font style='font-size: 15px;'><a href='/{$controller}/addReview/{$knjiga->getIdb()}'>Add review</a></font></p>";
                    
                    if($controller == 'Administrator' || $controller == 'Privilegovani') {
                       echo " <p class='quote' name='quote'><font style='font-size: 15px;'><a href='/{$controller}/addQuote'>Add quote</a></font></p>";
                    
                    }
                    echo "  </form>";
                    
                    echo "</div>";                    
                }
            
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12" style="text-align: center; margin-top: 2vh;">';
                    echo "  <form name='dodajNaWantListu' method='GET' action='". site_url("{$controller}/dodajNaWantListu")."'>";
                    echo "<a href=''><button  class='addtolist'>Add to Want to Read</button></a> ";
                    echo "<input type='hidden' name='idb' value=".$knjiga->getIdb().">";
                    echo "  </form>";
                    echo "</div>";                     
                }
                
                
                if ($controller == 'Administrator' || $controller == 'Privilegovani' || $controller == 'Korisnik') {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12" style="text-align: center; margin-top: 2vh;"">';
                    echo "  <form name='dodajNaReadListu' method='GET' action='". site_url("{$controller}/dodajNaReadListu")."'>";
                    echo "<a href=''><button class='addtolist'>Add to Read</button></a> ";
                    echo "<input type='hidden' name='idb' value=".$knjiga->getIdb().">";
                    echo "  </form>";
                    echo "</div>";             
                }
            ?>
            
            
            
            <br>&nbsp;
            <div class="col-lg-3">&nbsp;</div>
        </div>
        <div class="row ">
            
            <div class="col gradient">
               &nbsp
            </div>
        </div>
        <div class="row" style="background: #ffeedf;">
            <div class="col " style="margin-left: 15px ;">
                <h1 class="textdugme" id="prikazireviews">Reviews</h1>
            </div> 
        </div>
        <div class="row ">
            
            <div class="col naopackegradient">
               &nbsp
            </div>
        </div>
        <div class="row" id="prikazkomentara" >
            <div class="col komentari">               
                <!--<hr><br>-->
                <?php 
                foreach ($komentari as $komentar) {
                    echo '<div class="media">';
                    if ($komentar->getUser()->getImage() == null) {
                        echo '<img src="\images\users\no_photo.jpg" class="mr-3" alt="No photo">';
                    } else {
                        echo '<img src="\images\users\\' . $komentar->getUser()->getIdu() . '.jpg" class="mr-3" alt="No photo">';
                    }
                    echo '  <div class="media-body">';
                    echo '      <h4 class="mt-0">' . $komentar->getUser()->getUsername() . '</h4>';
                    if ($controller == 'Privilegovani' || $controller == 'Administrator') {
                        if (session()->get('korisnik')->getIdu() != $komentar->getUser()->getIdu()) {
                            echo "  <button class='prijavaKorisnika {$komentar->getUser()->getIdu()}' value='" . site_url("$controller/prijaviKorisnika/" . $komentar->getUser()->getIdu()) . "'>Report user</button>";
                        }
                    }
                    if($controller=="Administrator")
                    {
//                        echo "<a href=".site_url("/Administrator/deleteReview/".$komentar->getIdrev())."><button class='brisanjeKomentara'>Delete review</button></a>";
                        echo "<button class='brisanjeKomentara {$komentar->getIdrev()}' value='".site_url("/Administrator/deleteReview/".$komentar->getIdrev())."'>Delete review</button>";
                    }
                    echo '      <p class="komentar">' . $komentar->getText() . '</p>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<br>';
                }
                ?>
            </div>
        </div>
 <div class="row ">
            
            <div class="col gradient">
               &nbsp
            </div>
        </div>
<div class="row" style="background: #ffeedf;"><div class="col " style="margin-left: 15px ;" >  <h1 class="textdugme" id="prikaziquotes">Quotes</h1> </div> </div>
 <div class="row ">
            
            <div class="col naopackegradient">
               &nbsp
            </div>
        </div>       
<div class="row" id="prikazcitata" >
          
            <div class="col komentari">
                
                <!--<hr><br>-->
                <?php 
                foreach ($citati as $citat) {
                    echo '<div class="media">';
                    if ($citat->getUser()->getImage() == null) {
                        echo '<img src="\images\users\no_photo.jpg" class="mr-3" alt="No photo">';
                    } else {
                        echo '<img src="\images\users\\' . $citat->getUser()->getIdu() . '.jpg" class="mr-3" alt="No photo">';
                    }
                    echo '  <div class="media-body">';
                    echo '      <h4 class="mt-0">' . $citat->getUser()->getUsername() . '</h4>';
                    echo '      <p class="komentar">' . $citat->getText() . '</p>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<br>';
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col gradient"><br>&nbsp;</div>
        </div>

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
        
        <script>
            $(document).ready(function(){
                if ($('.toast')) {
                    $('.toast').toast('show');
                }
            });
        </script>

        
       
