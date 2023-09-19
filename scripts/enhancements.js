"use strict";


function calculatePrice() {
    var moviePrices = [0,20.99, 19.99, 18.99];
    var movieIndex = document.getElementById("movie").selectedIndex;
    var movieP = moviePrices[movieIndex];
    var seats = parseInt(document.getElementById("seats").value);
    var ticketPrice = movieP * seats;
    var optionsPrice = 0;
    var options = document.getElementsByName("options[]");
    for (var i = 0; i < options.length; i++) {
        if (options[i].checked) {
          optionsPrice += parseFloat(options[i].value) * seats;
        }
    }
    var totalPrice = ticketPrice + optionsPrice;
    sessionStorage.total = totalPrice;
    document.getElementById("totprice").innerHTML = "Total Price: RM" + totalPrice.toFixed(2);
}

function applyHeight() {
  var div1 = document.getElementById('a1');
  var div2 = document.getElementById('a2');
  var div3 = document.getElementById('a3');
  var divH1 = div1.offsetHeight;
  var divH2 = div2.offsetHeight;
  var divH3 = div3.offsetHeight;
  var asideE1 = document.getElementById('as1');
  var asideE2 = document.getElementById('as2');
  var asideE3 = document.getElementById('as3');
  asideE1.style.height = divH1 - 6 + 'px';
  asideE2.style.height = divH2 - 6 + 'px';
  asideE3.style.height = divH3 - 6 + 'px';
}

setInterval(applyHeight, 100);
