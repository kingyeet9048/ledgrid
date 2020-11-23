function en() {
    var encryptedUser = '"' + CryptoJS.SHA256(document.getElementById('username').value.toString()) + '"';
    var encryptedPass = '"' + CryptoJS.SHA256(document.getElementById('password').value.toString()) + '"';
    // alert('Username: ' + encryptedUser + ' Password: ' + encryptedPass);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = this.responseText.toString();
        }
      };
    xhr.open("POST", 'php/action.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(JSON.stringify({
        'username': encryptedUser,
        'password': encryptedPass
    }));
}