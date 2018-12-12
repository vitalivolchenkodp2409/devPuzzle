<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contacts from devPuzzle</title>
</head>
<body>      
  <h2>You have mail from:</h2>
  <h3>Name: {{ $data['name'] }}</h3>
  <h3>Email: {{ $data['email'] }}</h3>
  <h3>Message: </h3><p style="font-size: 15px;">{{ $data['message'] }}</p>  
</body>
</html>