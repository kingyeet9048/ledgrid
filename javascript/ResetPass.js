function reset() {
    var CurrentPass = CryptoJS.SHA256(document.getElementById('CP').value.toString(CryptoJS.enc.Base64));
    var NewPass = CryptoJS.SHA256(document.getElementById('NP').value.toString(CryptoJS.enc.Base64));
    var ActivationCode = CryptoJS.SHA256(document.getElementById('AC').value.toString(CryptoJS.enc.Base64));
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText.toString());
            window.location.href = this.responseText.toString();
        }
      };
    xhr.open("POST", 'signup.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(JSON.stringify({
        'currentPassword': CurrentPass.toString(CryptoJS.enc.Base64),
        'newPassword': NewPass.toString(CryptoJS.enc.Base64),
        'code': ActivationCode.toString(CryptoJS.enc.Base64)
    }));
}