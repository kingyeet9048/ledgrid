function en() {
    var encryptedUser = CryptoJS.AES.encrypt(document.getElementById("username").value, "SweetTea");
    var encryptedPass = CryptoJS.AES.encrypt(document.getElementById("password").value, "SweetTea");
    //U2FsdGVkX18ZUVvShFSES21qHsQEqZXMxQ9zgHy+bu0=
    
    //var decrypted = CryptoJS.AES.decrypt(encrypted, "SweetTea");
    //4d657373616765
    
    //document.getElementById("username").value = encryptedUser;
    //document.getElementById("password").value = encryptedPass;
   // document.getElementById("demo2").innerHTML = decrypted;
    //document.getElementById("demo3").innerHTML = decrypted.toString(CryptoJS.enc.Utf8);
}