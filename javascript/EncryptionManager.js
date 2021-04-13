// This file if for encrpyted sends to php files.
//You should only encryted vital info like passwords or codes. 

function en() {
    // non encryted username. 
    var encryptedUser = document.getElementById('username').value;
    // This an example of an encrypted password. 
    var encryptedPass = CryptoJS.SHA256(document.getElementById('password').value.toString(CryptoJS.enc.Base64));
    // Make a new connection object. 
    var xhr = new XMLHttpRequest();
    // This will run everything inside the function of the connection was vaild and good (No code breaking errors.)
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = this.responseText.toString();
            // alert(this.responseText.toString());

        }
      };
    // open a new connection to the action.php file using the secure POST
    xhr.open("POST", 'php/action.php', true);
    // HEADER type that tells what kind of data is being sent. 
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // send the request along with some data like the username and password. 
    // This send can be sent without anything inside the JSON.stringify({})
    xhr.send(JSON.stringify({
        'username': encryptedUser,
        'password': encryptedPass.toString(CryptoJS.enc.Base64)
    }));
}

// Same idea from above applies to the function, just more complicated. 
function pushSignUp(input) {
    // tells if the all of the fields in sigh up are blank or not.   
    var isNotBlank = true;
    // hold an array of all the blank fields. 
    var blanks = [];
    // get everything inside the document that was provided via "input"
    var inputs = input.children; 
    // go through all of the signup fields and check if 
    // they are blank or not.      
    for (let index = 0; index < inputs.length; index++) {
        // if it is not, continue to the next. 
        if (inputs[index].value) {
            continue;
        }
        //else push the name of the blank field to the 
        // blank array and make the isNotBlank false
        //this means that at least one field is blank. 
        else {
            blanks.push(inputs[index].id);
            isNotBlank = false;
        }
        
    }
    // if there are no blanks, go ahead and send the request..
    if (isNotBlank) {
        //getting the values of the fields. 
        var select = document.getElementById("select");
        var userType = select.options[select.selectedIndex].value;        
        var encryptedFirst = document.getElementById('FirstName').value;
        var encryptedLast = document.getElementById('LastName').value;
        var encryptedEmail = document.getElementById('Email').value;
        var encryptedUser = document.getElementById('Username').value;
        var encryptedPass = CryptoJS.SHA256(document.getElementById('Password').value.toString(CryptoJS.enc.Base64));
        var encryptedCode = CryptoJS.SHA256(document.getElementById('ActCode').value.toString(CryptoJS.enc.Base64));

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = this.responseText.toString();
                // alert(this.responseText.toString());
            }
        };
        xhr.open("POST", 'registerUser.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // A specific kind of request needs to be sent for each type
        // of user. 
        if(userType == "Admin") {
            xhr.send(JSON.stringify({
                'first': encryptedFirst,
                'last': encryptedLast,
                'email': encryptedEmail,
                'username': encryptedUser,
                'password': encryptedPass.toString(CryptoJS.enc.Base64),
                'code': encryptedCode.toString(CryptoJS.enc.Base64),
                'userType': userType
            }));
        }

        if(userType == "Faculty") {
            var select = document.getElementById("SelectDepartment");
            var encryptedDepartment = select.options[select.selectedIndex].value;
            xhr.send(JSON.stringify({
                'first': encryptedFirst,
                'last': encryptedLast,
                'email': encryptedEmail,
                'username': encryptedUser,
                'password': encryptedPass.toString(CryptoJS.enc.Base64),
                'code': encryptedCode.toString(CryptoJS.enc.Base64),
                'department': encryptedDepartment,
                'userType': userType
            }));
        }
        if(userType == "Student") {
            var majorSelect = document.getElementById("SelectID");
            var major = majorSelect.options[majorSelect.selectedIndex].value;
            xhr.send(JSON.stringify({
                'first': encryptedFirst,
                'last': encryptedLast,
                'email': encryptedEmail,
                'username': encryptedUser,
                'password': encryptedPass.toString(CryptoJS.enc.Base64),
                'code': encryptedCode.toString(CryptoJS.enc.Base64),
                'major': major,
                'userType': userType
            }));
        }
    }
    // There is at least one blank, sending an error. 
    else {
        alert("Error: Please put values into these fields - " + blanks.toString());
    }
}