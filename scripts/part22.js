"use strict";
var debug = true; // Global boolean variable to control validation

	/*get variables from form and check rules*/
function validate(){
  if (debug) {
    return true; // Skip validation if debug is true
  }
	var errMsg = "";								/* stores the error message */
	var result = true;
	var ccName = document.getElementById("cname").value;
  	var ccType = document.getElementById("ctype").value;
  	var ccNumber = document.getElementById("cnum").value;

    

  // Credit card name validation
  if (!ccName.match(/^[a-zA-Z\s]{1,40}$/)) {
    errMsg += "Name on the credit card must be maximum of 40 characters, alphabetical, and space only\n";
    result = false;
  }

  // Credit card number validation
  switch (ccType) {
    case "visa":
      if (!ccNumber.match(/^4\d{15}$/)) {
        errMsg += "Invalid Visa card number. Visa cards have 16 digits and start with a 4\n";
        result = false;
      }
      break;
    case "mastercard":
      if (!ccNumber.match(/^5[1-5]\d{14}$/)) {
        errMsg += "Invalid Mastercard number. MasterCard cards have 16 digits and start with digits 51 through to 55\n";
        result = false;
      }
      break;
    case "amex":
      if (!ccNumber.match(/^3[47]\d{13}$/)) {
        errMsg += "Invalid American Express card number. American Express cards have 15 digits and start with 34 or 37\n";
        result = false;
      }
      break;
    default:
      errMsg += "Invalid credit card type. Credit card type must be one of Visa, Mastercard, or American Express\n";
      result = false;
      break;
  }

  if (errMsg !== "") {
    alert(errMsg);
  }
  if (result) {
    storeB(ccName, ccType, ccNumber);
  }							/* assumes no errors */
	return result;    //if false the information will not be sent to the server
}


function storeB(cname, ctype, cnum){
	var cexp = document.getElementById("cexp").value;
	var ccvv = document.getElementById("ccvv").value;

	sessionStorage.cname = cname;
    sessionStorage.cnum = cnum;
    sessionStorage.ctype = ctype;
    sessionStorage.cexp = cexp;
    sessionStorage.ccvv = ccvv;
}

function getBooking(){
	var cost = 0;
	if(sessionStorage.firstname != undefined){    //if sessionStorage for username is not empty
		//confirmation text
		document.getElementById("confirm_name").textContent = sessionStorage.firstname + " " + sessionStorage.lastname;
		document.getElementById("confirm_email").textContent =sessionStorage.email;
		document.getElementById("confirm_straddr").textContent = sessionStorage.straddr;
		document.getElementById("confirm_suburbtown").textContent = sessionStorage.suburbtown;
		document.getElementById("confirm_state").textContent =sessionStorage.state;
		document.getElementById("confirm_postcode").textContent = sessionStorage.postcode;
		document.getElementById("confirm_phonenum").textContent = sessionStorage.phonenum;
		document.getElementById("confirm_movie").textContent = sessionStorage.movie;
		document.getElementById("confirm_date").textContent = sessionStorage.date;
		document.getElementById("confirm_time").textContent = sessionStorage.time;
		document.getElementById("confirm_seats").textContent = sessionStorage.seats;
    	var frmatTotal = parseFloat(sessionStorage.total).toFixed(2);
   		document.getElementById("confirm_opt").textContent = sessionStorage.opt;
   		document.getElementById("confirm_total").textContent = frmatTotal;
		document.getElementById("confirm_comment").textContent = sessionStorage.comment;
		//cost = calcCost();
		//document.getElementById("confirm_cost").textContent = cost;
		//fill hidden fields
		document.getElementById("firstname").value = sessionStorage.firstname;
	    document.getElementById("lastname").value = sessionStorage.lastname;
	    document.getElementById("email").value = sessionStorage.email;
	    document.getElementById("straddr").value = sessionStorage.straddr;
	    document.getElementById("suburbtown").value = sessionStorage.suburbtown;
	    document.getElementById("state").value = sessionStorage.state;
	    document.getElementById("postcode").value = sessionStorage.postcode;
	    document.getElementById("phonenum").value = sessionStorage.phonenum;
		  document.getElementById("movie").value = sessionStorage.movie;
	    document.getElementById("date").value = sessionStorage.date;
	    document.getElementById("time").value = sessionStorage.time;
	    document.getElementById("seats").value = sessionStorage.seats;
	    document.getElementById("opt").value = sessionStorage.opt;
    	document.getElementById("total").value = sessionStorage.total;
    	document.getElementById("comment").value = sessionStorage.comment;
	}
}

function cancelBooking(){
    sessionStorage.clear();
    window.location = "index.html";
}


function init() {
    getBooking();

    var bookForm = document.getElementById("bookform");
    bookForm.onsubmit = validate;

    var cancelButton = document.getElementById("cancelButton");
    cancelButton.onclick = cancelBooking;
}


window.onload = init;
