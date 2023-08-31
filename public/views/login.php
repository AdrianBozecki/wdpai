<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>MEAL FUEL</h1>
        </div>

        <div class="login-container">
            <form class="login", action="login", method="POST">
                <div class="form-group">
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo "<span class='error-message'>" . $message . "</span>";
                            }
                        }
                        ?>
                    </div>
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                </div>
                <div class="buttons">
                    <button type="submit">sign in</button>
                    <a href="/register"><button type="button">sign up</button></a>
                </div>
                
            </form>
        </div>
    </div>
</body>