<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; }
        .login-container { padding: 40px; border: 1px solid #ccc; border-radius: 5px; background-color: #fff; width: 350px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"], input[type="email"] { 
            width: 100%;
            padding: 15px; 
            font-size: 16px; 
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: all 0.3s ease; 
            box-sizing: border-box;
        }
        /* This is the "wow" effect when you click on an input */
        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
            border-color: #007bff; 
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5); 
            outline: none; 
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
        }
        button:hover { 
            background-color: #0056b3; 
        }
        .error-message { 
            color: #dc3545; 
            font-size: 12px; 
            margin-top: 5px; 
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message" style="border: 1px solid #dc3545; padding: 10px; margin-bottom: 15px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/login/process" method="POST">
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <p>
                <a href="/register">I Don't Have An Account</a>
            </p>

            <button type="submit">Log In</button>

        </form>
    </div>

</body>
</html>