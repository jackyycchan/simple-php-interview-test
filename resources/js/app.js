function getPrice() {
    var quote = document.getElementById("quote");
    if (quote.value.length == 0) {
        setMsg("Please enter a quote");
        return;
    } else {
        setMsg("");
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById("result").innerHTML = this.responseText;
        }
        xmlhttp.open("GET", "GetPrice.php?q=" + quote.value);
        xmlhttp.send();
    }
}

function setMsg(msg) {
    document.getElementById("msg").innerHTML = msg;
}
