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
            var ids = ['name', 'role', 'email'];
            document.getElementById(ids[0]).innerHTML = results[1] + " " + results[2];
            document.getElementById(ids[1]).innerHTML = results[3];
            document.getElementById(ids[2]).innerHTML = results[4];
        }

    }
};
xhr.open("POST", '../php/callProfile.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(JSON.stringify({}));

