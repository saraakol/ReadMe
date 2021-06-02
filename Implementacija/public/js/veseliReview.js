function checkAndSubmit(){
    if(document.getElementById("reviewText").value.trim()==="")
    {
        alert("Cannot submit empty review");
    }
    else
    {
        document.getElementById("addReviewForm").submit();
    }
}

