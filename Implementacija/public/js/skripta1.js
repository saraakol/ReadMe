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
    
    //Ucitan je progress bar
    if ($(".progress").length) {
        let username = $("#progressUsername").val();
        let personalGoal = $("#progressPersonalGoal").val();
        $.ajax({
            type: "GET",
            url: "\\php\\personalGoal.php?username=" + username
        }).done(function(result) {
            $("#brojProcitanihCilj").prepend(result + "/" + personalGoal + " books read!");
            $("#progressBarDiv").css("width", Math.floor((result * 100) / personalGoal) + "%");
            $("#progressBarText").append(Math.floor((result * 100) / personalGoal) + "%");
        });
    }
});