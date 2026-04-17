<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

<div class="wrapper">
    <form method="POST">

        <h2>Register</h2>

        <?php if (!empty($error)): ?>
            <p class="message error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="message success"><?= $success ?></p>
        <?php endif; ?>

        <div class="input-box">
            <input type="text" name="name" required>
            <label>Name</label>
        </div>

        <div class="input-box">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>

        <div class="input-box">
            <input type="password" name="password" required>
            <label>Password</label>
        </div>

        <button type="submit" class="btn">Register</button>

        <div class="login-register">
            <p>Already have an account? 
                <a href="login.php">Login</a>
            </p>
        </div>

    </form>
</div>

</body>
</html>