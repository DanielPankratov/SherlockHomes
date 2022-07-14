function SetImageName(id) { 
    var BigImage = document.getElementById("bigImage");
    var newsource = document.getElementById(id).src;
    BigImage.src=newsource;
}