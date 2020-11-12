<!-- This is a simple index.php script to ajax request the php json contents from our api. 
To see the results look in the console of your browser engine such as the chrome console -->
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="text-center">
<form><input type="search" id="result"></input></form>
<button type="button" onclick="query()" value="submit">submit</button>
</body>

<script>
function query() {
    $.ajax({ 
        type: 'GET', 
        url: 'api.php', 
        data: { host: $("#result").val() }, 
        dataType: 'json',
        success: function (data) { 
            console.log(data);
        }
        
    });
}
</script>
</html>