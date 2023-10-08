"use strict";

var debug = true; // Global boolean variable to control validation

function getPrefCon() {
  var pref = "Unknown";

  var prefarray = document.getElementsByName("preferred-contact");

  for (var i = 0; i < prefarray.length; i++) {
    if (prefarray[i].checked) {
      pref = prefarray[i].value; 
    }
  }

  sessionStorage.setItem("prefcontact", pref);

  return pref;
}



function validate() {
    if (debug) {
      return true; // Skip validation if debug is true
    }
    var errMsg = "";
    var result = true;

    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;
    var postcode = document.getElementById("postcode").value;
    var phonenum = document.getElementById("phonenum").value;
    var seats = document.getElementById("seats").value;


    if (!firstname.match(/^[a-zA-Z]+$/)) {
        errMsg = errMsg + "Your first name must only contain alpha characters\n";
        result = false;
    }

    if (!lastname.match(/^[a-zA-Z\-]+$/)) {
        errMsg = errMsg + "Your last name must only contain alpha characters\n";
        result = false;
    }

    if (isNaN (postcode)){
        errMsg = errMsg + "The Postcode must be a number\n";
        result = false;
    }
    if (isNaN (phonenum)){
        errMsg = errMsg + "Your Phone number must be a number\n";
        result = false;
    }
    else if (phonenum<1000000000||phonenum>999999999999) {
        errMsg = errMsg + "Your phone number must contain between 10 to 12 digits\n";
        result = false;
    }

    if (seats<1||seats>10){
        errMsg = errMsg + "The number of seats must be between 1 and 10\n";
        result = false;
    }

    if (document.getElementById("movie").value == "none"){
        errMsg += "You must select a movie\n";
        result = false;
    }

    if (document.getElementById("time").value == "none"){
        errMsg += "You must select a time\n";
        result = false;
    }

    if (document.getElementById("date").value == "none"){
        errMsg += "You must select a date\n";
        result = false;
    }

    if (document.getElementById("state").value == "none"){
    errMsg += "You must select a state\n";
    result = false;
    } else {
    var firstDigit = parseInt(postcode.charAt(0));

    switch (state) {
      case "VIC":
        if (firstDigit !== 3 && firstDigit !== 8) {
          errMsg += "Invalid postcode for VIC state. Postcode must start with 3 or 8.\n";
          result = false;
        }
        break;
      case "NSW":
        if (firstDigit !== 1 && firstDigit !== 2) {
          errMsg += "Invalid postcode for NSW state. Postcode must start with 1 or 2.\n";
          result = false;
        }
        break;
      case "QLD":
        if (firstDigit !== 4 && firstDigit !== 9) {
          errMsg += "Invalid postcode for QLD state. Postcode must start with 4 or 9.\n";
          result = false;
        }
        break;
      case "NT":
        if (firstDigit !== 0) {
          errMsg += "Invalid postcode for NT state. Postcode must start with 0.\n";
          result = false;
        }
        break;
      case "WA":
        if (firstDigit !== 6) {
          errMsg += "Invalid postcode for WA state. Postcode must start with 6.\n";
          result = false;
        }
        break;
      case "SA":
        if (firstDigit !== 5) {
          errMsg += "Invalid postcode for SA state. Postcode must start with 5.\n";
          result = false;
        }
        break;
      case "TAS":
        if (firstDigit !== 7) {
          errMsg += "Invalid postcode for TAS state. Postcode must start with 7.\n";
          result = false;
        }
        break;
      case "ACT":
        if (firstDigit !== 0) {
          errMsg += "Invalid postcode for ACT state. Postcode must start with 0.\n";
          result = false;
        }
        break;
    }
  }

  
  if (errMsg != ""){
    alert(errMsg);
  }
  if(result){
    storeBooking(firstname, lastname, postcode, phonenum, seats);
  }

  return result;
}

function storeBooking(firstname, lastname, postcode, phonenum, seats){
    //get values and assign them to a sessionStorage attribute.
    //we use the same name for the attribute and the element id to avoid confusion
    var opt1 = document.getElementById("opt1").checked;
    var opt2 = document.getElementById("opt2").checked;
    var opt3 = document.getElementById("opt3").checked;
  
    var opt = [];
    if (opt1) opt.push("Popcorn");
    if (opt2) opt.push("Soda");
    if (opt3) opt.push("Cookies");

    var optS = opt.join(", ");

    var email = document.getElementById("email").value;
    var straddr = document.getElementById("straddr").value;
    var suburbtown = document.getElementById("suburbtown").value;
    var state = document.getElementById("state").value;
    var movie = document.getElementById("movie").value;
    var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var comment = document.getElementById("comment").value;

    // Store all values in sessionStorage
    sessionStorage.firstname = firstname;
    sessionStorage.lastname = lastname;
    sessionStorage.email = email;
    sessionStorage.straddr = straddr;
    sessionStorage.suburbtown = suburbtown;
    sessionStorage.state = state;
    sessionStorage.postcode = postcode;
    sessionStorage.phonenum = phonenum;
    sessionStorage.movie = movie;
    sessionStorage.date = date;
    sessionStorage.time = time;
    sessionStorage.seats = seats;
    sessionStorage.opt = optS;
    sessionStorage.opt1 = opt1; // store checkbox values separately
    sessionStorage.opt2 = opt2;
    sessionStorage.opt3 = opt3;
    sessionStorage.comment = comment;
}

function prefill_form(){
  if (sessionStorage.firstname != undefined){
    document.getElementById("firstname").value = sessionStorage.firstname;
    document.getElementById("lastname").value = sessionStorage.lastname;
    document.getElementById("email").value = sessionStorage.email;
    document.getElementById("straddr").value = sessionStorage.straddr;
    document.getElementById("suburbtown").value = sessionStorage.suburbtown;
    document.getElementById("state").value = sessionStorage.state;
    document.getElementById("postcode").value = sessionStorage.postcode;
    document.getElementById("phonenum").value = sessionStorage.phonenum;
    
    var prefcontact = sessionStorage.getItem("prefcontact", getPrefCon());

    if (prefcontact) {
        var radioButtons = document.getElementsByName("preferred-contact");
        for (var i = 0; i < radioButtons.length; i++) {
          if (radioButtons[i].value === prefcontact) {
            radioButtons[i].checked = true;
            break;
          }
        }
    }
    document.getElementById("date").value = sessionStorage.date;
    document.getElementById("time").value = sessionStorage.time;
    document.getElementById("seats").value = sessionStorage.seats;
    document.getElementById("opt").value = sessionStorage.opt;
    document.getElementById("opt1").checked = sessionStorage.opt1 === "true";
    document.getElementById("opt2").checked = sessionStorage.opt2 === "true";
    document.getElementById("opt3").checked = sessionStorage.opt3 === "true";

    document.getElementById("comment").value = sessionStorage.comment;
    calculatePrice();
  }
}

function prefill_moviename(){
  var selectedMovie = sessionStorage.movie;
    var selectElement = document.getElementById("movie");
    
    // Loop through the options and set the selected one based on the value
    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].value === selectedMovie) {
            selectElement.options[i].selected = true;
            break; // Exit the loop once the match is found
        }
    }
}


function init() {
  var regForm = document.getElementById("regform");
  regForm.onsubmit = validate;
  prefill_form();
}

document.addEventListener('DOMContentLoaded', function() {
  prefill_moviename();
});

window.onload = init;