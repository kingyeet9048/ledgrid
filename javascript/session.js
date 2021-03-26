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
    var session = getCookie('Session');
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

console.log('Starting Timer...');
setCookie("Session", "Winona", 1);
setTimeout(resetSession, 300000);
