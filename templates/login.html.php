<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-box">
            <form action="" method="POST">
                <h2>Login</h2>
                
                <?php if($error): ?> 
                    <p style="color: #ff4d4d; text-align: center; font-weight: bold;"><?= $error ?></p> 
                <?php endif; ?>

                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                </div>

                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>