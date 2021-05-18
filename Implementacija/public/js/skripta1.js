$(document).ready(function() {
    $("#unosCilja").hide();
   
    $("#dodajCiljDugme").click(function() {
        $(this).hide();
        $("#unosCilja").show();
    });
    
    $("#prekiniCilj").click(function() {
        $("#unosCilja").hide();
        $("#dodajCiljDugme").show();
    });
});