var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        // this.responseText.toString();
        // alert(this.responseText.toString());
        var container = document.getElementById("newCards");
            
        if(this.responseText.toString() != '404') {
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }

            var results = this.responseText.toString().split("%%");
            var posts = ['MessageTop Reuse', 'MessageMiddle Reuse', 'MessageBottom Reuse'];
            for (let i = 0; i< posts.length; i++) {
                var currentDiv = document.createElement('div');
                currentDiv.style.margin = "3rem;";
                currentDiv.className = "alert alert-warning alert-dismissible fade show";
                currentDiv.role = "alert";
                container.appendChild(currentDiv);
                var title = document.createTextNode(posts[i] + "\n");
                currentDiv.appendChild(title);
                for (let index = 0; index < results.length; index++) {
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

