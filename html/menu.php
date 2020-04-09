<!----------------------------------------------------------------------------------
    @fichier  menu.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     Septembre 2019
    @version  v1.2 - First release						
    @details  menu /Menu pour toutes les pages du site Aggregator 
------------------------------------------------------------------------------------>
<?php 
    require_once('definition.inc.php');
    $ini  = parse_ini_file(CONFIGURATION, true);
?>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="/Ruche/">
			<img alt="Beehive logo" height="30" id="nav-Beehive-logo" src="/Ruche/images/beehive_logo.png" style="padding: 0 8px; ">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		
		
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
        
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a class="nav-link" href="/Ruche/accueil" id="nav-sign-in">Browse Sites</a>
			</li>					
			<li class="nav-item">
				<a class="nav-link" href="/Ruche/webcam" id="nav-sign-in">Webcam</a>
			</li>	
        </ul>
		
		<!-- Menu à droite -->
		<ul class="navbar-nav navbar-right" style="margin-right: 78px;">
			<li class="nav-item">
				
				<?php 
				if (!isset($_SESSION['login']))
					echo '<a class="nav-link" href="/Ruche/administration/" id="nav-sign-in">Sign In</a>';
				else{
					echo '<li class="nav-item dropdown">';
					
					echo '<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">';
						echo '<img alt="Avatar" height="30" id="nav-avatar-logo" src="/Ruche/images/icon-avatar.svg" style="padding: 0 10px; ">';
						echo $_SESSION['login']; 
					echo '</a>';
					echo '<div class="dropdown-menu">';
					if ($_SESSION['login'] == "root"){
						echo '<a class="dropdown-item" href="/Ruche/administration/users">Users</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/things">Things</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/channels">Channels</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/thingHTTPs">ThingHTTP</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/sent">SMS</a>';
						//echo '<a class="dropdown-item" href="/Ruche/administration/baseDeDonnees">Database</a>';
						//echo '<a class="dropdown-item" href="/Ruche/administration/infoSystem">System info</a>';
						//echo '<a class="dropdown-item" href="/Ruche/administration/battery">Battery</a>';
					}	
					else{
						echo '<a class="dropdown-item" href="/Ruche/administration/users">My Account</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/things">My things</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/channels">My Channels</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/thingHTTPs">My ThingHTTP</a>';
						echo '<a class="dropdown-item" href="/Ruche/administration/sent">My SMS</a>';
					}	
					
					
					
					
					
					echo '<a class="dropdown-item" href="/Ruche/administration/signout" id="nav-sign-in">Sign Out</a>';
					echo '</div>';
					echo '</li>';
				}	
				?>
			</li>
		</ul>
        
		</div>
    </nav>
	
	
		
		