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
    
    //Popunjavamo progress bar kada se stranica ucita
    $(".progress").ready(function() {
        let personalGoal = $("#progressPersonalGoal").val();
        let read = $(this).find("input[type=hidden]").val();

        $("#brojProcitanihCilj").prepend(read + "/" + personalGoal + " books read!");
        $("#progressBarDiv").css("width", Math.floor((read * 100) / personalGoal) + "%");
        $("#progressBarText").append(Math.floor((read * 100) / personalGoal) + "%");
    });
    
    //Na pocetku su zabranjena dugmad za dodavanje/uklanjane zanrova jer nije selektovan ni jedan zanr
    $("#dodajZanrForma input[type=submit], #ukloniZanrForma input[type=submit]").prop("disabled", true);
    
    //Kada se selektuje neki zanr, dugmad za dodavanje/uklanjane zanrova postaju omogucena
    $("#dodajZanrForma select, #ukloniZanrForma select").change(function() {
        $(this).parent().find("input[type=submit").prop("disabled", false);
    });
    
    //Na pocetku su sakrivene forme za dodavanje/uklanjanje zanrova
    $("#dodajZanrForma, #ukloniZanrForma").hide();
    
    //Kada se pritisne dugme za dodavanje zanra, prikazi formu za dodavanje 
    $("#dodajZanrDugme").click(function() {
        $("#dodajZanrDugme, #ukloniZanrDugme").hide();
        $("#dodajZanrForma").show();
    });
    
    //Kada se pritisne dugme za uklanjanje zanra, prikazi formu za uklanjanje
    $("#ukloniZanrDugme").click(function() {
        $("#dodajZanrDugme, #ukloniZanrDugme").hide();
        $("#ukloniZanrForma").show();
    });
    
    //Kada se klikne cancel, sakriva se forma i prikazuju dugmad opet
    $(".prekiniZanr").click(function() {
        $("#dodajZanrForma, #ukloniZanrForma").hide();
        $("#dodajZanrDugme, #ukloniZanrDugme").show();
    });
    
    //Kada se pritisne prijava korisnika, dugme se disabluje
    $(".prijavaKorisnika").click(function () {
        
        let url = $(this).val();
//        let idu = url.charAt(url.length-1);
        let args=url.split("/");
        let idu=args[args.length-1];
        
        let buttons=$(".prijavaKorisnika."+idu);
        buttons.prop("disabled", true);
        buttons.html("Reported");
        
        $.ajax({
            type: "GET",
            url: url
        }).done(function(result) {
            buttons.html("Reported");
        });
        
    });
    
    //Kada administrator prihvati zahtev, dugme se disabluje i nakon obrade zahteva, zahtev se uklanja
    $(".acceptZahtev, .declineZahtev").click(function() {
        
        $(this).prop("disabled", true);
        $(this).val("Processing..");
        let url = $(this).parent().find("input[type=hidden]").val();
        let thisOne = $(this);
        $.ajax({
            type: "GET",
            url: url
        }).done(function(result) {
            $(thisOne).parent().parent().parent().remove();
            $(".toast-zahtevi .toast-body").html(result);
            $(".toast-zahtevi").toast("show");
        });
    });
    
    $(".brisanjeKomentara").click(function() {
        
        $(this).prop("disabled", true);
        $(this).html("Processing..");
        let url = $(this).val();
        console.log(url);
        let thisOne = $(this);
        $.ajax({
            type: "GET",
            url: url
        }).done(function(result) {
            $(thisOne).parent().parent().remove();
//            $(".toast-zahtevi").toast("show");
        });
    });
    


  $("#prikaziquotes").click(function(){
        if($("#prikazcitata").is(":visible")){
           $("#prikazcitata").hide(); 
        }
        else{
            
            $("#prikazcitata").show();
        }
    });
    $("#prikazireviews").click(function(){
        if($("#prikazkomentara").is(":visible")){
           $("#prikazkomentara").hide();
        }
        else{
            
            $("#prikazkomentara").show();
        }
    });

});

function kliknutalistawant() {
    let checkBox = document.getElementById("wantlist");

    
    if (checkBox.checked == false) {
        $(".wantlist").hide();
    } else {
        $(".wantlist").show();
        $(".alllist").hide();
        $(".readlist").hide();
        $(".subscribedlist").hide(); 
        $(".recommendedlist").hide();
        document.getElementById("alllist").checked = false;
        document.getElementById("readlist").checked = false;
        document.getElementById("subscribedlist").checked = false;
        document.getElementById("recommendedlist").checked = false;
        
    }
}

function kliknutalisaall() {
    let checkBox = document.getElementById("alllist");

    
    if (checkBox.checked == false) {
        $(".alllist").hide();
    } else {
       $(".alllist").show();
        $(".readlist").hide();
        $(".subscribedlist").hide();
        $(".wantlist").hide();
        $(".recommendedlist").hide();
        document.getElementById("readlist").checked = false;
        document.getElementById("subscribedlist").checked = false;
        document.getElementById("wantlist").checked = false;
        document.getElementById("recommendedlist").checked = false;
    }
}

function kliknutalistaread() {
    let checkBox = document.getElementById("readlist");

    
    if (checkBox.checked == false) {
        $(".readlist").hide();
    } else {
        $(".readlist").show();
        $(".alllist").hide();
        $(".subscribedlist").hide();
        $(".wantlist").hide();
        $(".recommendedlist").hide();
        document.getElementById("alllist").checked = false;
        document.getElementById("subscribedlist").checked = false;
        document.getElementById("wantlist").checked = false;
        document.getElementById("recommendedlist").checked = false;
    }
}

function kliknutalistasubscribed(){
    let checkBox = document.getElementById("subscribedlist");

    
    if (checkBox.checked == false) {
        $(".subscribedlist").hide();
    } else {
        $(".subscribedlist").show();
        $(".alllist").hide();
         $(".readlist").hide();
        $(".wantlist").hide();
        $(".recommendedlist").hide();
        document.getElementById("alllist").checked = false;
        document.getElementById("readlist").checked = false; 
        document.getElementById("wantlist").checked = false;
        document.getElementById("recommendedlist").checked = false;
    }
}

function kliknutalistarecommended(){
    let checkBox = document.getElementById("recommendedlist");

    
    if (checkBox.checked == false) {
        $(".recommendedlist").hide();
    } else {
        $(".recommendedlist").show();
        $(".alllist").hide();
        $(".readlist").hide(); 
        $(".subscribedlist").hide();
        $(".wantlist").hide(); 
        document.getElementById("alllist").checked = false; 
        document.getElementById("readlist").checked = false; 
        document.getElementById("subscribedlist").checked = false;
        document.getElementById("wantlist").checked = false; 
    }
}