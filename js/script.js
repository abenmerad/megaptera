$(document).ready(function(){

    setTimeout(function() {
        $('#reussite').fadeOut('slow');
    }, 3000);
//Déclaration des variables necessaires à la vérification du formulaire

var listGrp = "select[name=Groupe]";
var listLieu = "select[name=Lieu]";
var maxIndividu = 20;

$("#infoLieu").hide();

    //Evenement de changement du SELECT de type de groupe
    $(listGrp).change(function(){
        //On récupere la valeur du groupe actuellement selectionné
        var valGrp = $(this).children("option:selected").val();
        if(valGrp != "NULL")
        {
            //On passe la valeur du groupe via une requete AJAX à la fonction ajouter du controleur membre
            requete = $.get("index.php?uc=observation&action=ajouter",
                {codeGrp : valGrp}
            )
            //Etant donné qu'en retour on recoit toute la page HTML, nous avons tronqué le contenu pour garder seuelement l'opérateur et la valeur qui correspondent aux deux derniers caractère
            .done(function(response, textStatus, jqXHR){
                var opr = response.substr(response.length - 2, response.length - 1);
                opr = opr.substr(0,1);
                var val = response.substr(response.length - 1);
                
                //On rempli le SELECT du nbIndividu en fonction de l'opérateur et de la valeur
                $("#lstNbrIndividu").children("option[value!='']").each(function()
                { 
                    $(this).remove();
                });
                switch(opr)
                {
                    case '>':
                        for (let index = maxIndividu; index > val ; index--)
                        {
                            $("#lstNbrIndividu").children("option[value='']").after("<option id=" + index +">"+index+"</option>");
                        }
                        break;
                    
                    case '%':
                        for (let index = val; index <= maxIndividu ; index++)
                        {
                            if((index % val) == 0)
                            {
                                $("#lstNbrIndividu").children("option[value='']").after("<option id=" + index +">"+index+"</option>");
                            }          
                        }
                        break;
                    
                    case '=':
                        $("#lstNbrIndividu").children("option[value='']").after("<option id=" + val +">"+val+"</option>");
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
        if(valLieu != "AUT")
        {
            $("#infoLieu").hide(1500);
            if(valLieu != "NULL")
            {
                $.get("index.php?uc=observation&action=ajouter",
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
                    $(this).prop("disabled", false);
            });
            latitude = undefined;
            longitude = undefined;
            $("#infoLieu").show(1500);
        }
    });
});