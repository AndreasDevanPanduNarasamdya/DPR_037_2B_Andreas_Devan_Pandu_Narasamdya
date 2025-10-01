<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        .welcome-box { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; text-align: center; }
        a { color: #007bff; }
    </style>
</head>
<body>
    <div class="welcome-box">
        <h1>Welcome, <?= esc($username) ?>!</h1>
        <p>You have successfully logged in as a Public user.</p>
        <p><a href="/logout">Log Out</a></p>
    </div>
</body>
</html>