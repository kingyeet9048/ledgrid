function en() {
    var encryptedUser = CryptoJS.SHA256(document.getElementById('username').value.toString(CryptoJS.enc.Base64));
    var encryptedPass = CryptoJS.SHA256(document.getElementById('password').value.toString(CryptoJS.enc.Base64));
    //alert("user " + encryptedUser + "pass " + encryptedPass);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText.toString());
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