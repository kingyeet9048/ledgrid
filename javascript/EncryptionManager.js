function en() {
    // var postForm = { //Fetch form data
    //     'username'     : $('input[name=username]').val(), //Store name fields value
    //     'password'     : $('input[name=password]').val() //Store name fields value
    // };

    // var encryptedUser = '';
    // var encryptedPass = '';
    // $.ajax({
    //     url: "../php/encrypt.php",
    //     type: "post",
    //     data: postForm,
    //     success: function (response) {
    //         encryptedUser = response.split("&")[0].toString();
    //         encryptedPass = response.split("&")[1].toString();
    //     }
    // });

    
    var encryptedUser = CryptoJS.SHA256(document.getElementById('username').value).toString();;
    var encryptedPass = CryptoJS.SHA256(document.getElementById('password').value).toString();;
    alert('Username: ' + encryptedUser + ' Password: ' + encryptedPass);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // window.location.href = this.responseText.toString();
        }
      };
    xhr.open("POST", 'php/action.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(JSON.stringify({
        'username': encryptedUser,
        'password': encryptedPass
    }));
}