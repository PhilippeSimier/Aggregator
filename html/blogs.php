<?php session_start(); 

require_once('./definition.inc.php');
require_once('./api/Api.php');
require_once('./api/Str.php');
require_once('./lang/lang.conf.php');

use Aggregator\Support\Api;
use Aggregator\Support\Str;

// connexion à la base
if (isset($_SESSION['time_zone']))
	$bdd = Api::connexionBD(BASE, $_SESSION['time_zone']);
else
	$bdd = Api::connexionBD(BASE);

function ajouterArticle(){
		if(isset($_SESSION['login'])){
			echo "<div class=\"alert alert-secondary\" style= \" border-color: gray; border-style: dashed; border-width: medium; border-radius: 8px; margin-top: 10px;\">\n";
			echo "<p><a href=\"./administration/blog?thingId={$_GET["id"]}\">Que voulez-vous dire aujourd'hui ?</a></p>\n";
			echo "</div>\n";
		}
}

function ajouterOutils($comment){
	if(isset($_SESSION['login'])){
		echo "<div class=\"outils\">";
		if ( $comment->status == "private"){
			echo "    <p><span id=\"{$comment->comment_id}\" class=\"update badge badge-warning \">{$comment->status}</span>";
		    echo "       <span id=\"{$comment->comment_id}\" class=\"delete badge  badge-danger\">X</span></p>\n";
		}
		else{
			echo "    <p><span id=\"{$comment->comment_id}\" class=\"update badge badge-success \">{$comment->status}</span>";
		    echo "       <span id=\"{$comment->comment_id}\" class=\"delete badge  badge-danger\">X</span></p>\n";
		}	
		echo "</div>";
	}
}

function afficherBlog($id){
	global $bdd;
	ajouterArticle();
	try {
				
		$sql  = "SELECT * FROM `vue_blogs` WHERE `things_id` = {$id} ";
		if(!isset($_SESSION['login'])) $sql .= " AND `status` = \"public\" ";
		$sql .= " ORDER BY `vue_blogs`.`visitDate` DESC";
		$stmt = $bdd->query($sql);

		while ($comment = $stmt->fetchObject()) {

			setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
			$date = strftime("%A %d %B %Y à %H:%M", strtotime( $comment->visitDate ));
			if ( !isset($_SESSION['time_zone'])) $date .= ' (UTC)';
			
			echo "<div class=\"blog-post popin\">\n";
			ajouterOutils($comment);
			echo "    <h2 class=\"blog-post-title\">{$comment->title}</h2>\n";
			echo "    <p class=\"blog-post-meta\">{$date} par {$comment->login} ";
			
			echo "    <p>{$comment->keyWord}</p><hr>\n";
			echo "    <p>{$comment->comment} </p>\n";
			echo "</div>\n";
		}
	} catch (\PDOException $ex) {
		echo($ex->getMessage());
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Blogs - Aggregator</title>
        <!-- Bootstrap CSS version 4.1.1 -->
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/ruche.css" />
		<link rel="stylesheet" href="./css/jquery-confirm.min.css" />
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="./scripts/popper.min.js"></script>
        <script src="./scripts/bootstrap.min.js"></script> 
		<script src="./scripts/jquery-confirm.min.js"></script>		
		
		
        <style>
			.outils {
				position:relative;
				float:right;
				cursor: pointer;
				font-size: 16px;
			}
			.update:before {
				content: "\f044";
				font-family: FontAwesome;
				text-decoration: inherit;
				color: #000;
				font-size: 20px;
				position: absolute;
				top: 5px;
				left: -25px;
			}
			
		</style>
        <script>
		   		
            $(document).ready(function () {
				
				let myOffset = new Date().getTimezoneOffset();
				console.log('myOffset ', myOffset);
				
				$('.update').on('click', function(e){
					console.log('clicked', this);
					let id = $(this).attr('id');
					let url = "administration/blog?id=" + id;
					console.log('url ', url);
					window.location.assign(url);
				}); 
				
				$('.delete').on('click', function(e){
					console.log('clicked', this);
					let id = $(this).attr('id');
					
					
					$.confirm({
						theme: 'bootstrap',
						title: 'Confirm!',
						content: 'Confirmez-vous la suppression du post ?',
						buttons: {
							confirm: {
								text: 'Confirmation', 
								btnClass: 'btn-blue', 
								action: function () {
								    console.log('suppression de id : ', id);
									
									$.post(
										'administration/deleteBlog.php', 
										{
											id : id 													
										},

										function(data){ 
											if(data == 'Success'){
												document.location.reload();
											}else{
												$.alert({
													theme: 'bootstrap',
													title: 'Alert!',
													content: "Oups on'a un problème !"
												});
											}	
										},

										'text' 
									);					
								}
							},
					 		cancel: {
								text: 'Annuler', // text for button
								action: function () {}
							}
						}
					});
					
				}); 
                
            });
        </script>

    </head>

    <body>

        <?php require_once 'menu.php'; ?>

        <div class="container" style="padding-top: 75px;" >
            <div style="min-height : 500px">
			    <div class="row">
					<div class="col-md-3 col-sm-12 col-xs-12">
						<div class="popin" >
							<h4>Archives</h4>
							<ul class="file-tree ">
								<li>2021</li>
								<li>2020</li>
								<li>2019</li>	
							</ul>
						</div>
					</div>
					<div class="col-md-9 col-sm-12 col-12">
						<?php afficherBlog($_GET["id"]) ?>
					</div>
				</div>
            </div>
            <?php require_once 'piedDePage.php'; ?>
        </div>
    </body>
</html>	
