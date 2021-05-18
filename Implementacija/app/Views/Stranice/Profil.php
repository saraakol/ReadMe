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
            <div class="col-sm-4 col-md-6 cilj">
                <button>Add Goal</button>
               <!-- <p><font style="font-size: 20px;">You have read 19 out of 35 books</font></p>
                <div style="width: 100%;" align="center">
                <div class="progress" style="width: 40%; height: 12%;" >
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%;">
                      40%
                    </div>
                </div></div>-->
            </div>
        </div>

