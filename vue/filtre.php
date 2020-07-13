<form id = "formAc" enctype="multipart/form-data" method="post" action="index.php?uc=controleur&action=filtre">
        <fieldset>
		<h2>Trier par : </h2>
		<div id ="filtre">
        <a for = "lieu">Lieu
		<select name="lstL">
			<option value="">Selectionner un lieu</option>
			<?php foreach($lieu as $l){ ?>
			<option value="<?php echo $l['Lieu'];?>"><?php echo $l['Lieu'];?></option>
			<?php } ?>
        </select>
		<a for = "anne">Année</a>
		<select name="lstA">
			<option value="">Selectionner l'année</option>
			<?php foreach($anne as $a){ ?>
			<option value="<?php echo $a['Année'];?>"><?php echo $a['Année'];?></option>
			<?php } ?>
        </select>
		<a for = "dominant">Dominant
		<select name="lstD">
			<option value="">Selectionner dominante</option>
			<?php foreach($dominant as $dom){ ?>
			<option value="<?php echo $dom['Dominant'];?>"><?php echo $dom['Dominant'];?></option>
			<?php } ?>
        </select>
		<a for = "caudale">Type Caudale</a><a id="lienPho" href="">*</a>
		<select name="lstTC">
			<option value="">Selectionner type de caudale</option>
			<?php foreach($TypeCaudale as $TC){ ?>
			<option value="<?php echo $TC['TypeCaudale'];?>"><?php echo $TC['TypeCaudale'];?></option>
			<?php } ?>
        </select>
		</div>
		<div id = "Button">
        <input type = "submit" value = "Valider" name = "valider">
        <input type = "reset" value = "Annuler" name = "annuler"> 
	    <BR><BR>
	    </div>