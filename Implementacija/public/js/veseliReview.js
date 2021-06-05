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

function checkpom(){
    if(document.getElementById("quotetext").value.trim()==="")
    {
        alert("Cannot submit empty quotes");
    }
    else
    {
        document.getElementById("formaQuote").submit();
    }
}