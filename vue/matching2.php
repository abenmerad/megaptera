<link rel="stylesheet" href="style/CssM.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<form enctype="multipart/form-data" method="post" action="index.php?uc=controleur&action=">
<div class="container">
  <h2>Carousel Example</h2>
  <img src="img<?php echo $photoV['Photo_caudale'];?>" style="width:100%;">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner">
			<div class="item active">
				<img data-lightbox="mygallery" src="img<?php echo $photo1['Photo_caudale'];?>" style="width:100%;">
			</div>
	
			<?php foreach($PhotoMatch as $photo){ ?>
			<div class="item">
				<img data-lightbox="mygallery" id="imgAM" value="<?php echo $photo['Photo_caudale'];?>" src="img<?php echo $photo['Photo_caudale'];?>" style="width:100%;">
			</div>
			<?php } ?> 
	  
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		
		</div>
	</div>
	<br>
	<div class="buttonMatching">
		<input type = "submit" value = "Valider" name = "valider">
		<input type = "reset" value = "Annuler" name = "annuler"> 
	</div>
</div>
</form>