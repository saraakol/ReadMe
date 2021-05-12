<?php
?>

	<div class="row">
            <div class="col-12">
		<div class="natpis">
                    <p class="naslov"> ReadMe</p>
                    <p class="ispodnaslova"> Gateway to Getaway</p>
		</div>
            </div>
	</div>
	<div class="row">
            <div class="col-12">
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
        <div class="row">  
            <div class="col gradient">
                <br>&nbsp;<br>&nbsp;<br>&nbsp;
            </div>
        </div>