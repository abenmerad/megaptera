$(document).ready(function(){

//Déclaration des variables necessaires à la vérification du formulaire

var listGrp = "select[name=Groupe]";
var listLieu = "select[name=Lieu]";
var maxIndividu = 20;

var formulaireValide = false;
var ajoutImgValide = false;
var selectLieuValide = false;
var infoLieuValide = false;
var selectCoordonneesValide = false;
var selectTimeValide = false;
var selectObservationEspece = false;

var selectValide = [];
var erreurs = $("#observationEspece .erreur");

$("#dateObservation").datepicker();

//Par défaut on cache toutes les div d'erreurs ainsi que le textarea d'informations de lieu.
//On met aussi les radio à l'état disabled par defaut
    $(".erreur").hide();
    $("#infoLieu").hide();
    $("input[type=radio]").each(function()
    { 
            $(this).prop("checked", false);
            $(this).prop("disabled", true);
    });

    //Evenement lorsque l'on clique sur le bouton Valider
    $("#submitForm").click(function(){
        //On vérifie l'entrée du fichier image
        if($("#ajoutImg input").val() != "")
        {
            ajoutImgValide = true;
            $("#ajoutImg .erreur").hide();
        } 
        else
        {
            ajoutImgValide = false;
            $("#ajoutImg .erreur").show();
        }

        //On vérifie le SELECT de lieu
        if($("#selectLieu select").val() != "NULL")
        {
            selectLieuValide = true;
            $("#selectLieu .erreur").hide();
        }
        else
        {
            selectLieuValide = false;
            $("#selectLieu .erreur").show();
        }
        //Si le textarea de lieu est visible on verifie son contenu
        if($("#lieuAutre").is(":visible"))
        {
            if($("#lieuAutre").val() != "")
            {
                $("#infoLieu .erreur").hide();
                infoLieuValide = true;
            }
            else
            {
                $("#infoLieu .erreur").show();
                infoLieuValide = false;
            }
        }
        else
        {
            $("#infoLieu .erreur").hide();
            infoLieuValide = true;
        }
        //Pour chaque entrée des coordonnées (Degré, seconde, minute) on vérifie que les valeurs sont bien comprises entre le min et le max
        $("#coordonneesLat input").each(function(){
            if($(this).val() >= parseInt($(this).attr("min"), 10) && $(this).val() <= parseInt($(this).attr("max"), 10))
            {
                $("#selectCoordonnees").prev().hide();
                selectCoordonneesValide = true;
                return;
            }
            else
            {
                $("#selectCoordonnees").prev().show();
                selectCoordonneesValide = false;
                return;
            }
        });

        //On vérifie que les champs d'heures et de date sont bien remplis
        if($("#heureDebut").val() != "" && $("#heureFin").val() != "" && $("#dateObservation").val() != "")
        {
            $("#selectTime").prev().hide();

            var heureDebut = new Date("January 1, 2000 " + $("#heureDebut").val());
            var heureFin = new Date("January 1, 2000 " + $("#heureFin").val());

            //On vérifie que l'heure de début d'observation n'est pas supérieur à l'heure de fin d'observation
            if(heureDebut > heureFin)
            {
                $("#selectTime").prev().after("<div class=\"erreur\">L'heure de debut doit être inférieur à l'heure de fin.</div>");
                selectTimeValide = false;
            }
            else
            {
                selectTimeValide = true;
            }
            
        }
        else
        {
            $("#selectTime").prev().show();
            selectTimeValide = false;
        }

        //On vérifie que tous les champs select du fieldset 'Caracteristique' sont bien remplis
        $("#observationEspece select").each(function(){
            if($(this).children("option:selected").val() != "NULL") //On vérifie si le select a été rempli ou pas
            {
                $(this).prev().hide();
                erreurs.each(function(){
                    if($(this).is(":hidden"))
                    {
                        selectValide.push("true");
                    }
                    else
                    {
                        selectValide.push("false")
                    }
                    
                });
                for(let i = 0; i < selectValide.length; i++)
                {
                    if(selectValide[i] == "true")
                    {
                        selectObservationEspece = true;
                    }
                    else
                    {
                        selectObservationEspece = false;
                        selectValide = [];
                        break;
                    }
                } 
                selectValide = [];
            }
            else
            {
                $(this).prev().show(); //On affiche un message d'erreur au niveau du select dont la valeur est NULL    
                selectObservationEspece = false; 
            }
        });
        //Si tous les champs ont bien été rempli, on peut commencer à préparer notre requete SQL
        if(ajoutImgValide && selectLieuValide && infoLieuValide && selectCoordonneesValide && selectTimeValide && selectObservationEspece)
        {
            var formulaire = new FormData($('form')[0]);

            var codeLieuObservation = $("#selectLieu select").val();
            var dateObservation = $("#dateObservation").val();
            var anneeObservation = dateObservation.split("-")[0];
            
            nomPhotoObservation = codeLieuObservation + "_" + anneeObservation + "_";
            formulaire.append('annee', anneeObservation);
            formulaire.append('nomObservation', nomPhotoObservation);
            $.ajax({
                enctype: 'multipart/form-data',
                url: "index.php?uc=menuMembre&action=Confirmer",
                data: formulaire,
                cache: false,
                contentType : false,
                processData : false,
                type: 'POST',
            }).done(function(data){
               console.log(data.split("<br>")[data.split("<br>").length-1]);
            }).fail(function(){
                alert("erreur");
            });

        } // Sinon on affiche une boite de dialogue d'erreur
        else
        {
            alert("Au moins une erreur a été détéctée dans le formulaire.");
        }
    });
    //Evenement de changement du SELECT de type de groupe
    $(listGrp).change(function(){
        //On récupere la valeur du groupe actuellement selectionné
        var valGrp = $(this).children("option:selected").val();
        if(valGrp != "NULL")
        {
            //On passe la valeur du groupe via une requete AJAX à la fonction ajouter du controleur membre
            requete = $.get("index.php?uc=menuMembre&action=ajouter",
                {codeGrp : valGrp}
            )
            //Etant donné qu'en retour on recoit toute la page HTML, nous avons tronqué le contenu pour garder seuelement l'opérateur et la valeur qui correspondent aux deux derniers caractère
            .done(function(response, textStatus, jqXHR){
                var opr = response.substr(response.length - 2, response.length - 1);
                opr = opr.substr(0,1);
                var val = response.substr(response.length - 1);
                
                //On rempli le SELECT du nbIndividu en fonction de l'opérateur et de la valeur
                $("#lstNbrIndividu").children("option[value!=NULL]").each(function()
                { 
                    $(this).remove();
                });
                switch(opr)
                {
                    case '>':
                        for (let index = maxIndividu; index > val ; index--) {
                            $("#lstNbrIndividu").children("option[value=NULL]").after("<option id=" + index +">"+index+"</option>");
                        }
                        break;
                    
                    case '%':
                        for (let index = val; index <= maxIndividu ; index++) {
                            
                            if((index % val) == 0)
                            {
                                $("#lstNbrIndividu").children("option[value=NULL]").after("<option id=" + index +">"+index+"</option>");
                            }          
                        }
                        break;
                    
                    case '=':
                        $("#lstNbrIndividu").children("option[value=NULL]").after("<option id=" + val +">"+val+"</option>");
                        break;
                }
            }); 
        }
        else
        {
            //On met à vide le SELECT nbIndividu 
            $("#lstNbrIndividu").children("option[value!=NULL]").each(function()
            { 
                    $(this).remove();
            });
        }
    });

    //Evenement de changement du SELECT de lieu
    $(listLieu).change(function(){
        //On recupere la valeur du Lieu (qui correspond à l'id du lieu dans la BD)
        var valLieu = $(this).children("option:selected").val();
        if(valLieu != "Autre")
        {
            $("#infoLieu").hide(1500);
            if(valLieu != "NULL")
            {
                $.get("index.php?uc=menuMembre&action=ajouter",
                    {codeLieu : valLieu},
                )
                .done(function(response, textStatus, jqXHR){
                    var orientationLat = response.substr(response.length - 2, response.length - 1);
                    var orientationLat = orientationLat.substr(0, 1);
                    var orientationLong = response.substr(response.length - 1);

                    $("input[name=latOrientation]").each(function(){
                        if($(this).val() == orientationLat)
                        {
                            $(this).prop("checked", true);
                            $(this).prop("disabled", false);
                            latitude = $(this).val();
                        }
                        else
                        {
                            $(this).prop("disabled", true);
                            $(this).prop("checked", false);
                        }
                    });
                    $("input[name=longOrientation]").each(function(){
                        
                        if($(this).val() == orientationLong)
                        {
                            $(this).prop("checked", true);
                            $(this).prop("disabled", false);
                            longitude = $(this).val();
                        }
                        else
                        {
                            $(this).prop("disabled", true);
                            $(this).prop("checked", false);
                        }
                    });
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                });
            }
            else
            {
                $("input[type=radio]").each(function()
                { 
                        $(this).prop("checked", false);
                        $(this).prop("disabled", true);
                });
                latitude = undefined;
                longitude = undefined;
            }
        }
        else
        {
            $("input[type=radio]").each(function()
            { 
                    $(this).prop("checked", false);
                    $(this).prop("disabled", true);
            });
            latitude = undefined;
            longitude = undefined;
            $("#infoLieu").show(1500);
        }
    });
});