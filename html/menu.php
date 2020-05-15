<!----------------------------------------------------------------------------------
    @fichier  menu.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     Avril 2020
    @version  v1.3 - First release						
    @details  menu /Menu pour toutes les pages du site Aggregator 
------------------------------------------------------------------------------------>
<?php 
    require_once('definition.inc.php');
	require_once('api/Str.php');
	use Aggregator\Support\Str;
	
	$racine = './';
	$repertoire = array('administration' , 'support' );  // les répertoires de prmier niveau du site
	if  (Str::contains($_SERVER['PHP_SELF'], $repertoire)){
		$racine = '../';
	}
	$repertoire = array('administration/support' );
    if  (Str::contains($_SERVER['PHP_SELF'], $repertoire)){
		$racine = '../../';
	}
?>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="<?php echo $racine ?>">
			<img alt="Beehive logo" height="30" id="nav-Beehive-logo" src="<?php echo $racine ?>images/beehive_logo.png" style="padding: 0 8px; ">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		
		
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
        
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $racine ?>accueil" id="nav-sign-in">Browse Sites</a>
			</li>					
			<li class="nav-item">
				<a class="nav-link" href="<?php echo $racine ?>webcam" id="nav-sign-in">Webcam</a>
			</li>	
        </ul>
		
		<!-- Menu à droite -->
		<ul class="navbar-nav navbar-right" style="margin-right: 78px;">
			<li class="nav-item">
				
				<?php 
				if (!isset($_SESSION['login']))
					echo "<a class='nav-link' href='{$racine}administration/' id='nav-sign-in'>Sign In</a>\n";
				else{
					echo "<li class='nav-item dropdown'>\n";
					
					echo "<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>\n";
					echo "<img alt='Avatar' height='30' id='nav-avatar-logo' src='{$racine}images/icon-avatar.svg' style='padding: 0 10px; '>\n";
					echo $_SESSION['login']; 
					echo "</a>\n";
					echo "<div class='dropdown-menu'>\n";
					if ($_SESSION['droits'] > 1){
						echo "<a class='dropdown-item' href='{$racine}administration/users'>Users</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/things'>Things</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/channels'>Channels</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/thingHTTPs'>ThingHTTPs</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/reacts'>Reacts</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/sms'>SMS</a>\n";
						
					}	
					else{
						echo "<a class='dropdown-item' href='{$racine}administration/users'>My Account</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/things'>Things</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/channels'>Channels</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/thingHTTPs'>ThingHTTPs</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/reacts'>Reacts</a>\n";
						echo "<a class='dropdown-item' href='{$racine}administration/sms'>SMS</a>\n";
					}	
					
					echo "<a class='dropdown-item' href='{$racine}administration/signout' id='nav-sign-in'>Sign Out</a>\n";
					echo "</div>\n";
					echo "</li>\n";
				}	
				?>
			</li>
		</ul>
        
		</div>
    </nav>
	
	
		
		