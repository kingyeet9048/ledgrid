function en() {
    var encryptedUser = document.getElementById('username').value;
    var encryptedPass = CryptoJS.SHA256(document.getElementById('password').value.toString(CryptoJS.enc.Base64));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = this.responseText.toString();
            // alert(this.responseText.toString());

        }
      };
    xhr.open("POST", 'php/action.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(JSON.stringify({
        'username': encryptedUser,
        'password': encryptedPass.toString(CryptoJS.enc.Base64)
    }));
}

function pushSignUp(input) {  
    var isNotBlank = true;
    var blanks = [];
    var inputs = input.children;      
    for (let index = 0; index < inputs.length; index++) {
        if (inputs[index].value) {
            continue;
        }
        else {
            blanks.push(inputs[index].id);
            isNotBlank = false;
        }
        
    }
    if (isNotBlank) {
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
    else {
        alert("Error: Please put values into these fields - " + blanks.toString());
    }
}