function reset() {
    // This section checks for blank fields. If they are,
    // they will be displayed and not allowed to continue. 
    var ids = ['resetemail', 'CP', 'NP', 'AC'];
    var blanks = [];
    var isNotBlank = true;
    for (let index = 0; index < ids.length; index++) {
        var currentElement = document.getElementById(ids[index]);
        if (currentElement.value) {
            continue;
        }
        else {
            blanks.push(currentElement.placeholder);
            isNotBlank = false;
        }
    }

    //if there are no blanks, go ahead. 
    if(isNotBlank) {
        //recieve the values. 
        var Email = document.getElementById("resetemail").value;
        var CurrentPass = CryptoJS.SHA256(document.getElementById('CP').value.toString(CryptoJS.enc.Base64));
        var NewPass = CryptoJS.SHA256(document.getElementById('NP').value.toString(CryptoJS.enc.Base64));
        var ActivationCode = CryptoJS.SHA256(document.getElementById('AC').value.toString(CryptoJS.enc.Base64));
        var xhr = new XMLHttpRequest();
        //URL will be return if everything is alright. 
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = this.responseText.toString();
            }
          };
        // Header info to tell what kind of conenction and data there will be. 
        xhr.open("POST", 'processreset.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //SEND THE CONNECTION ALONG WITH SOME ADDED DATA.
        xhr.send(JSON.stringify({
            'resetemail': Email,
            'currentPassword': CurrentPass.toString(CryptoJS.enc.Base64),
            'newPassword': NewPass.toString(CryptoJS.enc.Base64),
            'code': ActivationCode.toString(CryptoJS.enc.Base64)
        }));
    }
    else {
        alert("Error: Please put values into these fields - " + blanks.toString());
    }
}