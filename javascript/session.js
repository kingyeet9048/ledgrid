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
        if(confirm("You have been inactive. Wish to continue?")) {
            setTimeout(resetSession, 600000);
            session = getCookie('N?A');
            close();
        }
        else {
            document.cookie = "Session=Winona; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = "home.php";
        }
    }
    else {
        close();
    }
}

setCookie("Session", "Winona", 10);

setTimeout(resetSession, 600000);

