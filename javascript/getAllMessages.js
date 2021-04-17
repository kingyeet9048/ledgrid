var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // if the server does not return a 404 go ahead and send 
        // the received info to the page. 
        if(this.responseText.toString() != '404') {

            var table = document.getElementById("table");
            // container.appendChild(table);
            //This is not a good practice, but thats how we are 
            //gonna do it. We are splitting the recieved info by
            // %%  - all the rows and %^% -- panel number
            var results = this.responseText.toString().split("%%");

            for (let index = 0; index < results.length; index++) {
                var pointer = results[index].split("%^%");
                var row = table.insertRow(index + 1);
                for (let index2 = 0; index2 < pointer.length; index2++) {
                    var element = pointer[index2];
                    var cell = row.insertCell(index2);
                    cell.innerHTML = element;
                }
            }
        }

    }
};
xhr.open("POST", '../php/adminAllMessages.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(JSON.stringify({}));