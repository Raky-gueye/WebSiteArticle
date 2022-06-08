<?php
include('db/Connexiondb.php');
function afficher_article()
{
	if(require("db/Connexiondb.php"))
	{
   $req=$DB->prepare("SELECT * , c.libelle as titreCat FROM article a LEFT JOIN categorie c ON  c.id=a.categorie  ORDER BY a.dateCreation DESC");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }	
}
$articles = afficher_article();

function afficher_categorie()
{
	if(require("db/Connexiondb.php"))
	{
		$req=$DB->prepare("SELECT * FROM categorie ");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }	
}
$categories = afficher_categorie();

if (isset($_GET['IdCat'])) {
   require("db/Connexiondb.php");
$req=$DB->prepare("SELECT * FROM article a LEFT JOIN categorie c ON c.id = a.categorie WHERE a.categorie =? ");
        $req->execute( array($_GET['IdCat']));
           
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mes articles</title>
	<link rel="stylesheet" type="text/css" href="css/main.css ">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https : //fonts.googleapis.com/css2?family= Quicksand: wght @500 & display=swap" rel="stylesheet">
	
</head>
<body>
		<header>
			<nav>
				<div class="logo">
					<p><a href="index.php"><span>A</span>RTICLES</a></p>
				</div>
				<div class="menu">
					<ul>
						<a href="index.php"><li>Acceuil</li></a>
						<?php foreach ($categories as $categorie): ?>
						<a href="index.php?IdCat=<?= ($categorie->id)?>"><li><?= ($categorie->libelle)?></li></a>
						<?php endforeach;?>
                        
					</ul>
				</div>
			</nav>
		</header>
		<h1 ><span>N</span>os différents <span>A</span>rticles</h1>
		<div class="site-container">
			<div class="article-container">
				<?php foreach ($articles as $article): ?>
				<article class="article-card">
					<h4 class="card-title"><?= ($article->titre)?></h4>
					<figure class="article-image">
						<img src="<?= ($article->image)?>">
					</figure>
					<div class="article-content">
						<a href="" class="card-category"><?= ($article->titreCat)?></a>
						<p><?= nl2br(htmlentities (substr($article->contenu,0 ,100))) ?></p>
					</div>
				</article>
			    <?php endforeach;?>
			</div>
		</div>
			<footer>
				<div class="first_line" id="contact">
					<div class="contact">
						
						<p>Adresse</p>
						
					</div>
				</div>
			</footer>
		</div>
	</div>
</body>
</html>
