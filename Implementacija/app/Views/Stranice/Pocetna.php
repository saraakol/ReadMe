<?php
?>

<br>&nbsp;<br>&nbsp;<br>&nbsp;
                    <p class="naslov"> ReadMe</p>
                    <p class="ispodnaslova"> Gateway to Getaway</p>

                    <br>&nbsp;<br>&nbsp;<br>&nbsp;
                    <nav class="navbar navbar-expand-sm justify-content-center"">
                        <ul class="navbar-nav">
                        <?php 
                            if ($controller != 'Gost') {
                                echo '<li class="nav-item">
                                        <a class="nav-link" href="#">Browse &nbsp;&nbsp;</a>
                                      </li>'
                                    .'<li class="nav-item">'
                                        .'<a class="nav-link" href="MyBooks.html">My Books &nbsp;&nbsp;</a>'
                                    .'</li>';
                            }
                        ?>
                        <?php
                            if ($controller == 'Administrator') {
                                echo '<li class="nav-item">
                                        <a class="nav-link" href="registrations.html">Registrations &nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="reports.html">Reports &nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="upgrades.html">Upgrade &nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="AddBook.html">Add Book &nbsp;&nbsp;</a>
                                    </li>';
                            }
                        ?>
                        </ul>
                    </nav>
                <br>&nbsp;
                </div>
            </div>
        </div>
        
        <div class="row ">          
            <div class="col drugired belapozadina">
                <p class="naslov2">Today a reader. Tomorrow a leader.</p>
            </div>
        </div>