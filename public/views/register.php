<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/reg.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER</title>
</head>

<body>
<div class="container">
    <div class="logo">
        <h1>MEAL FUEL</h1>
    </div>
    <div class="login-container">
        <form class="register" action="register" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="lastname" type="text" placeholder="lastname">
            <input name="phone" type="text" placeholder="phone">
            <button type="submit">REGISTER</button>
        </form>
    </div>
</div>
</body>