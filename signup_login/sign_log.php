<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Login</title>
</head>

<body>
<link rel="stylesheet" href="../">

    <br>
    <br>
    <div class="cont">
        <div class="form sign-in">
            <h2>Welcome</h2>
            <!-- Login form -->
            <form action="../signup_login/login.php" method="post">
                <!-- ... existing input fields ... -->
                <button type="submit" class="submit">Sign In</button>
            </form>
        </div>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Don't have an account? Please Sign up!<h3>
                </div>
                <div class="img__text m--in">
                    <h3>If you already have an account, just sign in.<h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">
                <h2>Create your Account</h2>
                <!-- Signup form -->
                <form action="../signup_login/signup.php" method="post">
                    <!-- ... existing input fields ... -->
                    <button type="submit" class="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
</body>

</html>
