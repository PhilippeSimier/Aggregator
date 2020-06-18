<!----------------------------------------------------------------------------------
    @fichier  piedDePage.php							    		
    @auteur   Philippe SIMIER (Touchard Washington le Mans)
    @date     Avril 2020
    @version  v2.0 - Second release						
    @details  pied de page pour le site web Aggregator 
------------------------------------------------------------------------------------>

	<footer>
		<br /><br />
        <hr>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<?php 
				$lien =  basename($_SERVER['SCRIPT_NAME']);
				echo "<p><a href = './support/{$langue}/{$lien}'>{$lang['docs_page']}</a></p>" ?>
			</div>
		
			<div class="col-md-6 col-sm-6 col-xs-12">
				<p style="float: right">Copyright &copy; Section Snir Lycée Touchard - le Mans</p>
			</div>
        </div>
    </footer>