document.getElementById("buyButton").addEventListener("click", function() {
    var buyDiv = document.getElementById("buyDiv");
    if (buyDiv.style.display === "none") {
        buyDiv.style.display = "block";
    } else {
        buyDiv.style.display = "none";
    }
});
document.getElementById("changeButton").addEventListener("click", function() {
    var changeDiv = document.getElementById("changeDiv");
    if (changeDiv.style.display === "none") {
        changeDiv.style.display = "block";
    } else {
        changeDiv.style.display = "none";
    }
});
