<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" /></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    
        $('#lieuAutre').hide(); // on cache le champ par défaut
        $('#CodeLieuAutre').hide(); // on cache le champ par défaut
        
        $('select[name="lstLieu"]').change(function() { // lorsqu'on change de valeur dans la liste
        var valeur = $(this).val(); // valeur sélectionnée
        
            if(valeur != '') { // si non vide
                if(valeur == 'Autre') { // si "autre lieu"
                    $('#lieuAutre').show();
                    $('#CodeLieuAutre').show();
                } else {
                    $('#lieuAutre').hide();
                    $('#CodeLieuAutre').hide();       
                }
            }
        });
        
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

        // quand on change de valeur dans lstGrp la fonction se lance
        $('#lstGrp').change(function() {
            var valeur = $(this).children("option:selected").attr('title');
            var i = $('#lstNbrIndividu').children("option").length;
            var operateur = valeur.split(";");

            for (var index = 1; index < i; index++)
            {
                $('#nbIndivid' + index).show();
                if (operateur[0] == ">") 
                {
                    $('#nbIndivid' + index).text(index);
                }
                else if(operateur[0] == "%")
                {
                    if(index % operateur[1] == 0){
                    $('#nbIndivid' + index).text(index);
                    }
                    else{
                    $('#nbIndivid' + index).hide();
                    }  
                }
                else if(operateur[0] == "=")
                {
                    if(index == 1)
                    {
                    $('#nbIndivid1').text(1);
                    }
                    else
                    {
                    $('#nbIndivid' + index).hide();
                    }  
                }
            }
        })
    });
</script>

<form enctype="multipart/form-data" method="post" action="index.php?uc=menuSuper&action=ValidationAjoutPhoto">
    <fieldset>
        <h1>Ajouter une Observation</h1>

		<div id = "form1">
		<p>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000000000000000000000000000000000000000000000000000000000000" />
            <label for = "img">Transfère le fichier</label>
            <input type="file" name="nomIMG" />
        </p>


        <p>
            <label for = "lieu">Lieu</label>
            <select name="lstLieu">
                <option value="NULL">Veuillez selectionner un lieu</option>
                <?php foreach($lesLieux as $lieu){ ?>
                    <option value="<?php echo $lieu['lieu'];?>"><?php echo $lieu['lieu'];?></option>
                <?php } ?>
                     <option value="Autre">Autre</option>
            </select>
            <br> <textarea id="lieuAutre"  type = "text"  name = "lieuAutre" size = "250" maxlength = "200" placeholder = "Veuillez entrer le nom du lieux , orientationlongitude  DMS, orientationlatitude DMS" rows="5" cols="33"></textarea>
	
           
            <table class "orientation">
			<tbody>
			 <tr>
			  <td class="td70"></td>
			  <td></td>
			  <td>degrés °</td>
			  <td>minutes'</td>
			  <td>secondes "</td>
			  </tr>
			  <tr>
			  <td>Latitute</td>
			  <td> 
			     <table class="tdp4">
				  <tbody>
				   <tr>
				     <td class ="td40">
					 <label class="textB" for="latOrientation">
					 <input type="radio" name="latOrientation" id="lat_dirN" value="N" onclick="ajaxStart_CooDirDP(&quot;latOrientation&quot;);" onkeypress="return submitenter(this, event);" checked="checked">
                     N
					 </label>
					 </td>
					  <td class ="td40">
					 <label class="textB" for="latOrientation">
					 <input type="radio" name="latOrientation" id="lat_dirS" value="S" onclick="ajaxStart_CooDirDP(&quot;latOrientation&quot;);" onkeypress="return submitenter(this, event);" >
                    S
					 </label>
					 </td>
		   <div>
                <input value="N" type="radio" id="RadioNord" name="RadioLat">
                <label for="scales">Nord</label>
				
            </div>
      
        <div>
            <input value="S" type="radio" id="RadioSud" name="RadioLat">
            <label for="scales">Sud</label>
        </div>
        <table class="orientation">
		<tbody>
			<tr>
				<td></td>
				
			</tr>
		</tbody>
		
		<tr>
		 <table class = "td40">
		 <tbody>
		 <tr>
		 
		<td>
       
        <input id="longDeg" name="longDeg"  type="text" size="2" maxlength="3" value="73" >°
       
	    </td>
		<td>
          <input id="longMin" name="longMin"  type="text" size="1" maxlength="2" value="59">'      
		  </td>

		<td>
        <input id="longSec" name="longSec"  type="text" size="1" maxlength="2" value="0">"
        </td>
		
        <center>
            <div>
                <input value="O" type="radio" id="RadioWest" name="RadioLong">
                <label for="scales">Ouest</label>
            </div>
        </center>
        <center>
            <div>
                <input value="E" type="radio" id="RadioEst" name="RadioLong">
                <label for="scales">Est</label>
            </div>
        </center>

        <label>Degres Longitude</label>
        <input name="DegresLong" id="number" type="number" value="1" min ="0" max = "180">
        <label>Minutes Longitude</label>
        <input name="MinutesLong" id="number" type="number" value="1" min ="0" max = "59">
        <label>Secondes Longitude</label>
        <input name="SecondesLong" id="number" type="number" value="1" min ="0" max = "59">

        <center>
            <script>
                $( function() {
                    $( "#datepicker" ).datepicker({
                        dateFormat : 'yy/mm/dd'
                    });
                });
            </script>
            <div class="calendrier">
                <p>Date: <input for = "annee" name = "annee" id="datepicker"></p>
            </div>
        </center>


        <p>
            <label for="appt" name="HeureDebut">heure de debut d'observation</label>
            <input type="time" id="HeureDebut" name="HeureDebut"> 
        </p>

        <p>
            <label for="appt" name="HeureFin">heure de fin d'observation</label>
            <input type="time" id="HeureFin" name="HeureFin"> 
        </p>

        <p>
            <label for = "dominante">Dominant</label>
            <select name="lstD">
                <option value="">Veuillez selectionner la dominante</option>
                <?php foreach($dominante as $d){ ?>
                    <option value="<?php echo $d['id'];?>"><?php echo $d['libelle'];?></option>
                <?php } ?>
            </select>
        </p>

        <center>
        <label for = "papillon">Papillon</label>
        <select name="lstP">
            <option value="NULL">Veuillez selectionner le papillon</option>
            <option value=1>Vrai</option>
            <option value=0>Faux</option>
        </select>
        </center>

        <center>
        <label for = "TypeDeCaudale">Type de Caudale</label>
        <a class="tooltip" href="">
            Type de Caudale
            <span><img src="images/typeCaudale/TypeCaudale.JPG">
            <h3>Les types de caudales</h3>
            </span>
        </a>

        <SELECT name="lstC">
            <option value="NULL">Veuillez selectionner le Type de Caudale</option>
            <OPTION value=1>Type 1</option>
            <OPTION value=2>Type 2</option>
            <OPTION value=3>Type 3</option>
            <OPTION value=4>Type 4</option>
            <OPTION value=5>Type 5</option>
        </SELECT>
        </center>

        <label for = "TypeDeGroupe">Type de Groupe</label>
        <SELECT name="lstGrp" id ="lstGrp">
            <option title ="" value="NULL">Veuillez selectionner le groupe</option>
			<?php foreach($Type as $LesGroupes){ ?>
                <option title="<?php echo $t['operateur'].";".$t['valeur']; ?>" value="<?php echo $t['code'];?>"><?php echo $t['libelle'];?></option>
			<?php } ?>
        </SELECT>

        <label for = "nbIndividus">Nombre d'individus</label>
        <SELECT name="lstNbrIndividu" id ="lstNbrIndividu">
            <option value="NULL">Veuillez selectionner le nombre d'individus</option>
            <?php for ($i=1; $i < 21 ; $i++) { ?>
                <option id = "<?php echo "nbIndivid".$i;?>"> <?php echo "nbIndivid".$i;?> </option>
			<?php } ?>
        </SELECT>

        <p>
            <label id="comm" for="com">Commentaire</label>
        </p>
        <div class="Comm">
            <p>
                <textarea id="commentaire"  type = "text"  name = "commentaire" size = "250" maxlength = "200" placeholder = "Commentaire" rows="5" cols="33"></textarea>
            </p>
        </div>

        <p>
            <label id="comm" for="comp">Comportement</label>
        </p>
        <div class="Comm">
            <p>
                <textarea id="comportement"  type = "text"  name = "comportement" size = "250" maxlength = "200" placeholder = "Comportement" rows="5" cols="33"></textarea>
            </p>
        </div>

		<div id = "Button">
            <input type = "submit" value = "Valider" name = "valider">
            <input type = "reset" value = "Annuler" name = "annuler"> 
	    </div>
	</fieldset>   
 </form>