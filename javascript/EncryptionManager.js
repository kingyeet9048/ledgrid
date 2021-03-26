function en() {
    var encryptedUser = CryptoJS.SHA256(document.getElementById('username').value.toString(CryptoJS.enc.Base64));
    var encryptedPass = CryptoJS.SHA256(document.getElementById('password').value.toString(CryptoJS.enc.Base64));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = this.responseText.toString();
        }
      };
    xhr.open("POST", 'php/action.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(JSON.stringify({
        'username': encryptedUser.toString(CryptoJS.enc.Base64),
        'password': encryptedPass.toString(CryptoJS.enc.Base64)
    }));
}

function pushSignUp() {
    var select = document.getElementById("select");
    var userType = select.options[select.selectedIndex].value;        
    var encryptedFirst = CryptoJS.SHA256(document.getElementById('FirstName').value.toString(CryptoJS.enc.Base64));
    var encryptedLast = CryptoJS.SHA256(document.getElementById('LastName').value.toString(CryptoJS.enc.Base64));
    var encryptedEmail = CryptoJS.SHA256(document.getElementById('Email').value.toString(CryptoJS.enc.Base64));
    var encryptedUser = CryptoJS.SHA256(document.getElementById('Username').value.toString(CryptoJS.enc.Base64));
    var encryptedPass = CryptoJS.SHA256(document.getElementById('Password').value.toString(CryptoJS.enc.Base64));
    var encryptedCode = CryptoJS.SHA256(document.getElementById('ActCode').value.toString(CryptoJS.enc.Base64));

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = this.responseText.toString();
        }
    };
    xhr.open("POST", 'registerUser.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    if(userType == "Admin") {
        xhr.send(JSON.stringify({
            'first': encryptedFirst.toString(CryptoJS.enc.Base64),
            'last': encryptedLast.toString(CryptoJS.enc.Base64),
            'email': encryptedEmail.toString(CryptoJS.enc.Base64),
            'username': encryptedUser.toString(CryptoJS.enc.Base64),
            'password': encryptedPass.toString(CryptoJS.enc.Base64),
            'code': encryptedCode.toString(CryptoJS.enc.Base64),
        }));
    }

    if(userType == "Faculty") {
        var encryptedDepartment = CryptoJS.SHA256(document.getElementById('Department').value.toString(CryptoJS.enc.Base64));
        xhr.send(JSON.stringify({
            'first': encryptedFirst.toString(CryptoJS.enc.Base64),
            'last': encryptedLast.toString(CryptoJS.enc.Base64),
            'email': encryptedEmail.toString(CryptoJS.enc.Base64),
            'username': encryptedUser.toString(CryptoJS.enc.Base64),
            'password': encryptedPass.toString(CryptoJS.enc.Base64),
            'code': encryptedCode.toString(CryptoJS.enc.Base64),
            'department': encryptedDepartment.toString(CryptoJS.enc.Base64)
        }));
    }
    if(userType == "Student") {
        var majorSelect = document.getElementById("SelectID");
        var major = majorSelect.options[majorSelect.selectedIndex].value;
        var encryptedMajor = CryptoJS.SHA256(major.toString(CryptoJS.enc.Base64));
        xhr.send(JSON.stringify({
            'first': encryptedFirst.toString(CryptoJS.enc.Base64),
            'last': encryptedLast.toString(CryptoJS.enc.Base64),
            'email': encryptedEmail.toString(CryptoJS.enc.Base64),
            'username': encryptedUser.toString(CryptoJS.enc.Base64),
            'password': encryptedPass.toString(CryptoJS.enc.Base64),
            'code': encryptedCode.toString(CryptoJS.enc.Base64),
            'major': encryptedMajor.toString(CryptoJS.enc.Base64)
        }));
    }
}