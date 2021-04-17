//These function are from w3shools on adding, getting, and removing a cookie. 
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

function resetSession() {
    var session = getCookie('PHPSESSID');
    if(session != "") {
        setTimeout(window.location.href = "../index.php", 300000);
    }
    else {
        close();
    }
}

function eraseCookie(name) {
  setCookie(name,"",-1);
}

// start a timer. When the timer ends
// the resetSession will return the user to the 
//index and their cookies will be deleted. 
// This is to prevent idling. 
console.log('Starting Timer...');
setTimeout(resetSession, 600000);
