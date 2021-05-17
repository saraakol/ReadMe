
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

function kliknutalistarecom() {
    let checkBox = document.getElementById("recomlist");

    
    if (checkBox.checked == false) {
        $(".recomlist").hide();
    } else {
        $(".recomlist").show();
    }
}

function kliknutalistagenre() {
    let checkBox = document.getElementById("genrelist");

    
    if (checkBox.checked == false) {
        $(".genrelist").hide();
    } else {
        $(".genrelist").show();
    }
}

$('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  console.log("aaa");
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});

document.querySelector("#file-upload").onchange = function(){
    console.log("aaa");
  document.querySelector("#file-name").textContent = this.files[0].name;
}