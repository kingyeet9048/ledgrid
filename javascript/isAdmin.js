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
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // if the server does not return a 404 go ahead and send 
        // the received info to the page. 
        if(this.responseText.toString() != '404') {
            //This is not a good practice, but thats how we are 
            //gonna do it. We are splitting the recieved info by
            // %%  - all the rows and %^% -- panel number
            var results = this.responseText.toString().split("%^%");
            if (results[0] == "Admin") {
                document.getElementById("admin").href = "AllMessages.php?sess=" + getCookie("PHPSESSID");
            }
        }

    }
};
xhr.open("POST", '../php/checkadmin.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(JSON.stringify({}));

