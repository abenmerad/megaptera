<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" /></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
    $('#lieuAutre').hide(); // on cache le champ par défaut
     
    $('select[name="lstL"]').change(function() { // lorsqu'on change de valeur dans la liste
    var valeur = $(this).val(); // valeur sélectionnée
     
        if(valeur != '') { // si non vide
            if(valeur == 'a') { // si "autre lieu"
                $('#lieuAutre').show();
            } else {
                $('#lieuAutre').hide();           
            }
        }
    });
 
});

$(document).ready(function() {
 
 $('#MBn').hide(); // on cache le champ par défaut
  
 $('select[name="lstGrp"]').change(function() { // lorsqu'on change de valeur dans la liste
 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'MB') { // si "autre lieu"
             $('#MBn').show();
         } else {
             $('#MBn').hide();           
         }
     }
 });

});

$(document).ready(function() {
 
 $('#MBEn').hide(); // on cache le champ par défaut
  
 $('select[name="lstGrp"]').change(function() { // lorsqu'on change de valeur dans la liste
 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'MBE') { // si "autre lieu"
             $('#MBEn').show();
         } else {
             $('#MBEn').hide();           
         }
     }
 });

});

$(document).ready(function() {
 
 $('#GCn').hide(); // on cache le champ par défaut
  
 $('select[name="lstGrp"]').change(function() { // lorsqu'on change de valeur dans la liste
 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'GC') { // si "autre lieu"
             $('#GCn').show();
         } else {
             $('#GCn').hide();           
         }
     }
 });

});

$(document).ready(function() {
 
 $('#GIn').hide(); // on cache le champ par défaut
  
 $('select[name="lstGrp"]').change(function() { // lorsqu'on change de valeur dans la liste
 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'GI') { // si "autre lieu"
             $('#GIn').show();
         } else {
             $('#GIn').hide();           
         }
     }
 });

});

$(document).ready(function() {
 
 $('#An').hide(); // on cache le champ par défaut
  
 $('select[name="lstGrp"]').change(function() { // lorsqu'on change de valeur dans la liste
 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'A') { // si "autre lieu"
             $('#An').show();
         } else {
             $('#An').hide();     
         }
     }
 });

});

$(document).ready(function() {
 
 $('#lstlongE').hide(); // on cache le champ par défaut
 $('#lstlongO').hide(); // on cache le champ par défaut
 $('#long').hide(); // on cache le champ par défaut

 $('select[name="lstlat"]').change(function() { // lorsqu'on change de valeur dans la liste

 var valeur = $(this).val(); // valeur sélectionnée
  
     if(valeur != '') { // si non vide
         if(valeur == 'N') { // si "autre lieu"
             $('#lstlongO').show();
             $('#lstlongE').hide();
             $('#long').show(); 
         } else if (valeur == 'S') {
             $('#lstlongE').show();
             $('#lstlongO').hide();
             $('#long').show();    
         }
         else
         {
            $('#lstlongE').hide(); // on cache le champ par défaut
            $('#lstlongO').hide(); // on cache le champ par défaut
            $('#long').hide(); // on cache le champ par défaut
         }
     }
 });

});
</script>

<form enctype="multipart/form-data" method="post" action="index.php?uc=controleur&action=ajout">
        <fieldset>

        <h1>Ajouter une Photo</h1>
        
		<div id = "form1">

		<p>
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000000000000000000000000000000000000000000000000000000000000" />
		<label for = "img">Transfère le fichier</label>
		<input type="file" name="nomIMG" />
        </p>

        <p>
        <label for = "lieu">Lieu</label>
		<select name="lstL">
			<option value="NULL">Veuillez selectionner un lieu</option>
			<?php foreach($lieu as $l){ ?>
			<option value="<?php echo $l['Lieu'];?>"><?php echo $l['Lieu'];?></option>
			<?php } ?>
			<option value="a">Autre</option>
        </select>
		<input id = "lieuAutre"  type = "text"  name = "lieuAutre" size = "30" maxlength = "45" placeholder = "Veuillez entrer le lieu">
        </p>

        <p>
        <label for = "lieu">Coordonées GPS</label>
        <SELECT id="lstlat" name = "lstlat">
			<option value="NULL2">Latitude</option>
            <option value="N">Nord</option>
            <option value="S">Sud</option>
        </SELECT>
        <input type="text" id="lat" name="lat"/> 
		</p>
		<center>
		<p>
        <SELECT id="lstlongE" name = "lstlongE">
			<option value="">Longitude</option>
			<option value="E">Est</option>
        </SELECT>
         
        <SELECT id="lstlongO" name = "lstlongO">
			<option value="">Longitude</option>
            <option value="O">Ouest</option>
        </SELECT>
        <input type="text" id="long" name="long"/> 
       </p>
	   </center>


       
        <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
        </script>
        <div class="calendrier">
        <p>Date: <input for = "anne" name = "anne" id="datepicker"></p>
        </div>


        <p>
        <label for="appt" name="HeureDebut">heure de debut d'observation</label>
        <input type="time" id="HeureDebut" name="HeureDebut"> 
        </p>

        <p>
        <label for="appt" name="HeureFin">heure de fin d'observation</label>
        <input type="time" id="HeureFin" name="HeureFin"> 
        </p>

        <p>
        <label for = "dominant">Dominant</label>
		<select name="lstD">
			<option value="">Veuillez selectionner la dominante</option>
			<?php foreach($dominant as $dom){ ?>
			<option value="<?php echo $dom['Dominant'];?>"><?php echo $dom['Dominant'];?></option>
			<?php } ?>
        </select>
        </p>


        <p>
        <FORM><label for = "TypeDeGroupe">Type de Groupe</label>
         <SELECT name="lstGrp">
         <option value="NULL">Veuillez selectionner le groupe</option>
            <OPTION value="MB">Mère Baleineau</option>
            <OPTION value="MBE">Mère Baleineau Escort</option>
            <OPTION value="GC">Groupe Compétitif</option>
            <OPTION value="GI">Groupe Immature</option>
            <OPTION value="S">Solitaire</option>
            <OPTION value="A">Autre</option>
        </SELECT>
        <center>
        <p>
        <SELECT id="MBn" name = "MBn">
         <option value="NULL2">nombre d'individu</option>
            <OPTION value="2">2</option>
            <OPTION value="4">4</option>
            <OPTION value="6">6</option>
            <OPTION value="8">8</option>
            <OPTION value="10">10</option>
            <OPTION value="12">12</option>
            <OPTION value="14">14</option>
            <OPTION value="16">16</option>
        </SELECT>
       </p>
       </center>
       <center>
        <p>
        <SELECT id="MBEn"  name = "MBEn">
         <option value="NULL3">nombre d'individu</option>
            <OPTION value="3">3</option>
            <OPTION value="6">6</option>
            <OPTION value="9">9</option>
            <OPTION value="12">12</option>
            <OPTION value="15">15</option>
            <OPTION value="18">18</option>
        </SELECT>
       </p>
       </center>
       <center>
        <p>
        <SELECT id="GCn" name = "GCn">
         <option value="NULL4">nombre d'individu</option>
            <OPTION value="1">1</option>
            <OPTION value="2">2</option>
            <OPTION value="3">3</option>
            <OPTION value="4">4</option>
            <OPTION value="5">5</option>
            <OPTION value="6">6</option>
            <OPTION value="7">7</option>
            <OPTION value="8">8</option>
            <OPTION value="9">9</option>
            <OPTION value="10">10</option>
            <OPTION value="11">11</option>
            <OPTION value="12">12</option>
            <OPTION value="13">13</option>
            <OPTION value="14">14</option>
            <OPTION value="15">15</option>
            <OPTION value="16">16</option>
            <OPTION value="17">17</option>
            <OPTION value="18">18</option>
        </SELECT>
       </p>
       </center>
       <center>
        <p>
        <SELECT id="GIn" name = "GIn">
         <option value="NULL4">nombre d'individu</option>
            <OPTION value="1">1</option>
            <OPTION value="2">2</option>
            <OPTION value="3">3</option>
            <OPTION value="4">4</option>
            <OPTION value="5">5</option>
            <OPTION value="6">6</option>
            <OPTION value="7">7</option>
            <OPTION value="8">8</option>
            <OPTION value="9">9</option>
            <OPTION value="10">10</option>
            <OPTION value="11">11</option>
            <OPTION value="12">12</option>
            <OPTION value="13">13</option>
            <OPTION value="14">14</option>
            <OPTION value="15">15</option>
            <OPTION value="16">16</option>
            <OPTION value="17">17</option>
            <OPTION value="18">18</option>
        </SELECT>
       </p>
       </center>
       <center>
        <p>
        <SELECT id="An" name = "An">
         <option value="NULL4">nombre d'individu</option>
            <OPTION value="1">1</option>
            <OPTION value="2">2</option>
            <OPTION value="3">3</option>
            <OPTION value="4">4</option>
            <OPTION value="5">5</option>
            <OPTION value="6">6</option>
            <OPTION value="7">7</option>
            <OPTION value="8">8</option>
            <OPTION value="9">9</option>
            <OPTION value="10">10</option>
            <OPTION value="11">11</option>
            <OPTION value="12">12</option>
            <OPTION value="13">13</option>
            <OPTION value="14">14</option>
            <OPTION value="15">15</option>
            <OPTION value="16">16</option>
            <OPTION value="17">17</option>
            <OPTION value="18">18</option>
        </SELECT>
       </p>
       </center>
         
        </FORM>
        </p>
        
        <p>
        <label for = "caudale">Type de Caudale</label><a id="lienPho" href="">*</a>
		<select name="lstTC">
			<option value="">Veuillez selectionner le type de caudale</option>
			<?php foreach($TypeCaudale as $TC){ ?>
			<option value="<?php echo $TC['TypeCaudale'];?>"><?php echo $TC['TypeCaudale'];?></option>
			<?php } ?>
        </select>
        </p>

        <p>
         <label for = "papillon">Papillon</label>
		<select name="lstP">
			<?php foreach($papillon as $p){ ?>
			<option value="<?php echo $p['Papillon'];?>"><?php echo $p['Papillon'];?></option>
			<?php } ?>
        </select>
        </p>

        </p>
        
        <p>
        <label id="comm" for="com">Commentaire</label>
        </p>
        <div class="Comm">
        <p>
        <textarea id="com"  type = "text"  name = "com" size = "250" maxlength = "200" placeholder = "Commentaire" rows="5" cols="33">
        </textarea>
        </p>
        </div>


        <p>
        <label id="comm" for="comp">Comportement</label>
        </p>
        <div class="Comm">
        <p>
        <textarea id="comp"  type = "text"  name = "comp" size = "250" maxlength = "200" placeholder = "Comportement" rows="5" cols="33">
        </textarea>
        </p>
        </div>


        </div>


		<div id = "Button">
       <input type = "submit" value = "Valider" name = "valider">
       <input type = "reset" value = "Annuler" name = "annuler"> 
	   <BR><BR>
	   <a id="AddL" href="index.php?uc=controleur&action=ajoutL">Ajouter un lieu</a>
	   </div>
	   </fieldset>
	   
 </form>