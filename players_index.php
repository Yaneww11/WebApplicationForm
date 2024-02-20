<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manchester United Players</title>
    <link rel="stylesheet" href="styles_and_script/players_style.css">
</head>
<body>
    <header>
        <div class="arrow"><a href="index.php">&#8656;</a></div>
        <div id="text">
            <h1>Manchester United players</h1>
            <p><b>2023/24</b></p>
        </div>
    </header>

    <main>
        <h2 class="heading_players">GOALKEEPERS</h2>
        <hr>
        <div class="row">
            <div class="card">
                <img src="/images/onana.webp" alt="Jane" style="width:100%">
                <div class="container">
                    <h2>Andre Onana</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/Atlay.webp" alt="Mike" style="width:100%">
                <div class="container">
                    <h2>Altay Bayindir</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/Heaton.webp" alt="John" style="width:100%">
                <div class="container">
                    <h2>Tom Heaton</h2>
                </div>
            </div>
        </div>

        <h2 class="heading_players">DEFENDERS</h2>
        <hr>
        <div class="row">
            <div class="card">
                <img src="/images/martinez.webp" alt="Martinez" style="width:100%">
                <div class="container">
                    <h2>Lisandro Martinez</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/varane.webp" alt="Varane" style="width:100%">
                <div class="container">
                    <h2>Raphael Varane</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/maguire.webp" alt="Maguire" style="width:100%">
                <div class="container">
                    <h2>Harry Maguire</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/lindelof.webp" alt="Lindelof" style="width:100%">
                <div class="container">
                    <h2>Victor Lindelof</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/shawwebp.webp" alt="Shaw" style="width:100%">
                <div class="container">
                    <h2>Luke Shaw </h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/dalot.webp" alt="Dalot" style="width:100%">
                <div class="container">
                    <h2>Diogo Dalot</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/bissaka.webp" alt="Bissaka" style="width:100%">
                <div class="container">
                    <h2>Aaron Wan-Bissaka</h2>
                </div>
            </div>
        </div>

        <h2 class="heading_players">MIDFIELDERS</h2>
        <hr>
        <div class="row">

            <div class="card">
                <img src="/images/bruno.webp" alt="Bruno Fernandes" style="width:100%">
                <div class="container">
                    <h2>Bruno &#xa9; Fernandes</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/casemiro.webp" alt="Casemiro" style="width:100%">
                <div class="container">
                    <h2>Casemiro</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/amrabat.webp" alt="Sofyan Amrabat" style="width:100%">
                <div class="container">
                    <h2>Sofyan Amrabat</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/mctominay.webp" alt="Scott McTominay" style="width:100%">
                <div class="container">
                    <h2>Scott McTominay</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/eriksen.webp" alt="Christian Eriksen" style="width:100%">
                <div class="container">
                    <h2>Christian Eriksen</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/maimoo.webp" alt="Kobbie Mainoo" style="width:100%">
                <div class="container">
                    <h2>Kobbie Mainoo</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/mount.webp" alt="Mason Mount" style="width:100%">
                <div class="container">
                    <h2>Mason Mount</h2>
                </div>
            </div>
        </div>

        <h2 class="heading_players">ATTACK</h2>
        <hr>
        <div class="row">

            <div class="card">
                <img src="/images/Rashford.webp" alt="Marcus Rashford" style="width:100%">
                <div class="container">
                    <h2>Marcus Rashford</h2>
                </div>
            </div>


            <div class="card">
                <img src="/images/garnacho.webp" alt="Alejandro Garnacho" style="width:100%">
                <div class="container">
                    <h2>Alejandro Garnacho</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/antony.webp" alt="Antony" style="width:100%">
                <div class="container">
                    <h2>Antony</h2>
                </div>
            </div>

            <div class="card">
                <img src="/images/hojlund.webp" alt="Rasmus Hojlund" style="width:100%">
                <div class="container">
                    <h2>Rasmus Hojlund</h2>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
