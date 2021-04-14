var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // A newCards div was made to hold all the new message suggestions. 
        var container = document.getElementById("newCards");
        // if the server does not return a 404 go ahead and send 
        // the received info to the page. 
        if(this.responseText.toString() != '404') {
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }

            //This is not a good practice, but thats how we are 
            //gonna do it. We are splitting the recieved info by
            // %%  - all the rows and %^% -- panel number
            var results = this.responseText.toString().split("%%");
            // TITles of the posts we will add to the page. 
            var posts = ['MessageTop Reuse', 'MessageMiddle Reuse', 'MessageBottom Reuse'];
            // for each post in the posts array.
            for (let i = 0; i< posts.length; i++) {
                //create a div container and add it to the main div container.
                var currentDiv = document.createElement('div');
                currentDiv.style.margin = "3rem;";
                currentDiv.className = "alert alert-warning alert-dismissible fade show";
                currentDiv.role = "alert";
                container.appendChild(currentDiv);
                // title was also added to the new div
                var title = document.createTextNode(posts[i] + "\n");
                currentDiv.appendChild(title);
                // for each row in the results array. 
                for (let index = 0; index < results.length; index++) {
                    //split the string and add it to the new div as a p tag. 
                    var currentRow = results[index].split("%^%")[i];
                    if(currentRow) {
                        var currentP = document.createElement('p');
                        var node = document.createTextNode(currentRow);
                        currentP.appendChild(node);
                        currentDiv.appendChild(currentP);
                    }
                }
            }
        }

    }
  };
xhr.open("POST", '../php/findContent.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.send(JSON.stringify({}));

