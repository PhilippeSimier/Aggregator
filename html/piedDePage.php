<!----------------------------------------------------------------------------------
    @fichier  piedDePage.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     Juillet 2018
    @version  v1.0 - First release						
    @details  pied de page pour le site web ruche 
------------------------------------------------------------------------------------>
	<footer>
		<br /><br />
        <hr>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<p><a href = "<?php 
				$tab = explode('/', $_SERVER['PHP_SELF'], 3);
				echo "support/" . $tab[2]; 
				?>">Aggregator - docs for this page</a></p>
			</div>
		
			<div class="col-md-6 col-sm-6 col-xs-12">
				<p>Copyright &copy; Section Snir Lycée Touchard - le Mans</p>
			</div>
        </div>
    </footer>