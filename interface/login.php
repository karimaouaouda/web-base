<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo include_asset('./sets/css/compiled/login.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> <?php echo $name; ?> </title>
</head>

<body>
    <div class="page">
        <div class="inner-page">
            <div class="login-container">
                <div class="inner-container">
                    <div class="title">
                        <h2>
                            <strong>
                                Login
                            </strong>
                        </h2>
                    </div>
                    <form action="/login" method="post" class="login">
                        <div class="error">

                        </div>
                        <div class="inpt email-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" placeholder="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="inpt pass-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input placeholder="password" type="password" name="password" id="pass" required>
                            </div>
                        </div>
                        <div class="forget">
                            <span>
                                forget password ? <a href="#">reset</a>
                            </span>
                        </div>
                        <div class="btn-container">
                            <button class="btn-white">
                                <i class="fas fa-sign-in"></i>
                                login
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="suggest">
                        <h4>
                            or login with :
                        </h4>
                    </div>
                    <div class="social-container">
                        <div class="row">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-google"></i>
                            <i class="fab fa-github"></i>
                            <i class="fab fa-twitter"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-container">
                <div class="inner-container">
                    <div class="title">
                        <h2>
                            <strong>
                                register
                            </strong>
                        </h2>
                    </div>
                    <form action="register" method="post" class="login">
                        <div class="error">
                            sorry
                        </div>
                        <div class="inpt name-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" placeholder="name" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="inpt email-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" placeholder="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="inpt pass-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input placeholder="password" type="password" name="password" id="pass" required>
                            </div>
                        </div>
                        <div class="inpt pass-inpt">
                            <div class="inner-inpt">
                                <span>
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input placeholder="confirm password" type="password" name="password_confirmation"
                                    id="pass_conf" required>
                            </div>
                        </div>
                        <div class="btn-container">
                            <button class="btn-white">
                                <i class="fas fa-sign-in"></i>
                                register
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="suggest">
                        <h4>
                            or register with :
                        </h4>
                    </div>
                    <div class="social-container">
                        <div class="row">
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-google"></i>
                            <i class="fab fa-github"></i>
                            <i class="fab fa-twitter"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel log-panel">
                <div class="panel-container log">
                    <div class="header">
                        <div class="img-box">
                            <div class="c">
                                <img src="./sets/images/sec-login.svg" alt="login picture">
                            </div>
                        </div>
                        <div class="text">
                            Login to your account with all safety you need
                        </div>
                    </div>
                    <div class="q">
                        <div class="m"></div>
                    </div>
                    <div class="or">
                        you havn't an account yet?
                    </div>
                    <div class="btn-container">
                        <button class="togglePannel btn-blue">
                            <i class="fas fa-arrow-left"></i> register now
                        </button>
                    </div>
                </div>
                <div class="panel-container reg">
                    <div class="header">
                        <div class="img-box">
                            <div class="c">
                                <img src="./sets/images/sec-login.svg" alt="login picture">
                            </div>
                        </div>
                        <div class="text">
                            create a new account with us with all safety you need
                        </div>
                    </div>
                    <div class="or">
                        already hav an account with us ?
                    </div>
                    <div class="btn-container">
                        <button class="togglePannel btn-blue">
                            login now <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var panelToggler = document.querySelectorAll('.togglePannel');
        var panel = document.querySelector('.panel');
        var regContainer = document.querySelector('.register-container');
        var logContainer = document.querySelector('.login-container');
        panelToggler.forEach(button => {
            button.onclick = () => {
                if (panel.classList.contains('reg-panel')) {
                    panel.classList.remove('reg-panel');
                    panel.classList.add('log-panel');
                    logContainer.style.opacity = "1";
                    regContainer.style.opacity = "0";

                } else {
                    panel.classList.remove('log-panel');
                    panel.classList.add('reg-panel');
                    logContainer.style.opacity = "0";
                    regContainer.style.opacity = "1";
                }
            }
        })
    </script>
</body>

</html>