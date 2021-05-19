<?php
?>

        <div class="row bio natpis">
            <div class="col-sm-4 col-md-3">
                <img src="\img\drazen.jpg" class="img-thumbnail" alt="No photo">
            </div>
            <div class="col-sm-4 col-md-3">
                <h1><?= $korisnik->getUsername(); ?></h1>
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
                <br><br>
                <!-- Ovde cu dodati ajax za prikaz pretplacenih i dodavanje/brisanje zanrova -->
                <button>Add genre</button>
            </div>
            <?php 
                if ($controller == 'Administrator' || $controller == 'Privilegovani') {
                    echo '<div class="col-sm-4 col-md-6 cilj">';
                    if ($korisnik->getPersonalGoal() == null) {
                        echo "<button id='dodajCiljDugme'>Add Goal</button>";
                        echo "<div id='unosCilja'>";
                        echo "  <h3>Insert goal:</h3>";
                        echo "  <form name='dodajCilj' method='get' action='" . site_url("$controller/dodajCilj") . "'>";
                        echo "      <input type='hidden' name='username' value='" . $korisnik->getUsername() . "'>";
                        echo "      <input type='number' name='brojKnjiga'><br><br>";
                        echo "      <input type='submit' name='dodajCilj' value='Accept'>";
                        echo "      <input type='button' id='prekiniCilj' value='Cancel'>";
                        echo "  </form>";
                        echo "</div>";
                    } else {
                        //Progress bar
                        echo "<h2 id='brojProcitanihCilj'></h2>";
                        echo "<div class='break-column'></div>";
                        echo "<div class='progress'>";
                        //Ajax ce popuniti progress bar informacijama
                        echo "  <input id='progressUsername' type='hidden' value='" . $korisnik->getUsername() . "'>";
                        echo "  <input id='progressPersonalGoal' type='hidden' value='" . $korisnik->getPersonalGoal() . "'>";
                        echo "  <div id='progressBarDiv' class='progress-bar progress-bar-striped bg-danger progress-bar-animated'>";
                        echo "      <b id='progressBarText'></b>";
                        echo "  </div>";
                        echo "</div>";
                    }
                    echo '</div>';                              
                }
            ?>
            </div>
        </div>

