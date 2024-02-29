<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morocco Trip Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            color: #666;
        }
        strong {
            font-weight: bold;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>In Morocco - Trip Information</h1>
        
        <h2>User Information:</h2>
        <p><strong>User Name:</strong> {{ $tripUser->user->name }}</p>
        <p><strong>Email:</strong> {{ $tripUser->user->email }}</p>
    
        <h2>Trip Details:</h2>
        <p><strong>ID:</strong> {{ $tripUser->trip->id }}</p>
        <p><strong>Trip destination:</strong> {{ $tripUser->trip->destination }}</p>
        <p><strong>city:</strong> {{ $tripUser->trip->city }}</p>
        <p><strong>Start Date:</strong> {{ $tripUser->trip->start_date }}</p>
        <p><strong>End Date:</strong> {{ $tripUser->trip->end_date }}</p>
    </div>
</body>
</html>
