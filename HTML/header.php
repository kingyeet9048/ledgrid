<!-- With the head in a new page, I can make as many pages and 
reuse the head as many times as I want. Makes for more efficient code. -->

<!-- There are two different sets of the same thing because our files are in
differnt locations so we need different paths. To avoid a complicated
solution, we have simply put them twice to fulfil both cases where the files
are in a folder like javascript, HTML, etc. or attached to the index that is outside 
of any of those kinds of folders.  -->
<head>
    <title>LEDGRID</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sulaiman Bada">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- INDEX.PHP -->
    <link rel="stylesheet" type="text/css" href='styles/styles.css'>
    <script src="javascript/EncryptionManager.js"></script>
    <script src="javascript/ResetPass.js"></script>
    <script src="javascript/signupOptions.js"></script>


    <!-- MAIN -->
    <link rel="stylesheet" type="text/css" href='../styles/styles.css'>
    <script src="../javascript/EncryptionManager.js"></script>
    <script src="../javascript/ResetPass.js"></script>
    <script src="../javascript/signupOptions.js"></script>
    <!-- OUTSIDE packages we need. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/core.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9/sha256.js"></script>   
</head>