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
    
    //Kada se pritisne Add genre, pomocu ajax-a dohvatamo iz baze sve zanrove na koje korisnik jos nije pretplacen i prikazujemo ih
    $("#dodajZanrForma").ready(function() {
        let idU = $(this).find("input[type=hidden]").filter(".idu").val();
        $.ajax({
            type: "GET",
            url: "\\php\\dohvatiZanrove.php?idU=" + idU + "&type=not-subscribed"
        }).done(function(result) {
            let zanrovi = result.split(';');
            let lista = $("#dodajZanrLista");
            for (let i = 0; i < zanrovi.length; i++) {
                let zanr = zanrovi[i].split('-');
                lista.append(
                    $("<option></option>").attr("value", zanr[0]).append(zanr[1])
                );
            }
        });
    });
    
    //Kada se pritisne Remove genre, pomocu ajax-a dohvatamo iz baze sve zanrove na koje je korisnik pretplacen i prikazujemo ih
    $("#ukloniZanrForma").ready(function() {
        let idU = $(this).find("input[type=hidden]").filter(".idu").val();
        $.ajax({
            type: "GET",
            url: "\\php\\dohvatiZanrove.php?idU=" + idU + "&type=subscribed"
        }).done(function(result) {
            let zanrovi = result.split(';');
            let lista = $("#ukloniZanrLista");
            for (let i = 0; i < zanrovi.length; i++) {
                let zanr = zanrovi[i].split('-');
                lista.append(
                    $("<option></option>").attr("value", zanr[0]).append(zanr[1])
                );
            }
        });
    });
    
    //Kada se pritisne prijava korisnika, dugme se disabluje
    $(".prijavaKorisnika").click(function () {
        $(this).prop("disabled", true);
        $(this).html("Reporting..");
        let button = $(this);
        let url = $(this).val();
        $.ajax({
            type: "GET",
            url: url
        }).done(function(result) {
            button.html("Reported");
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
        });
    });
});

function kliknutalistawant() {
    let checkBox = document.getElementById("wantlist");

    
    if (checkBox.checked == false) {
        $(".wantlist").hide();
    } else {
        $(".wantlist").show();
    }
}

function kliknutalisaall() {
    let checkBox = document.getElementById("alllist");

    
    if (checkBox.checked == false) {
        $(".alllist").hide();
    } else {
        $(".alllist").show();
    }
}

function kliknutalistaread() {
    let checkBox = document.getElementById("readlist");

    
    if (checkBox.checked == false) {
        $(".readlist").hide();
    } else {
        $(".readlist").show();
    }
}