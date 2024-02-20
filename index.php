<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location: login.php");
}
function check_verified()
{
    include ('config.php');
    $id = $_SESSION['user']['id'];
    $sql = "select * from users_with_verification where id = '$id' limit 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row['email'] == $row['email_verified']){
        return True;
    }
    return False;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yane's favourite team</title>
    <link rel="stylesheet" href="styles_and_script/index_style.css">
    <link rel="icon" href="/images/logo.png">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <header id="header" >
        <div class="club_icon"><img class="header" src="/images/logo.png" alt="logo" id="logo"></div>
        <h1 class="header"> Manchester United</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="crud_index.php">Your data</a></li>
                <?php if(!check_verified()):?>
                    <li><a href="verify.php">Verify email</a></li>
                <?php endif;?>
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </nav>
        <label for="nav-toggle">
            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
        </label>
    </header>

    <div class="row">
        <div class="col-1 menu">
            <ul>
                <li id="table"><details>
                    <summary>  Matches this month </summary>
                    <table>
                        <tbody>
                        <tr class="days">
                            <th>Mo</th>
                            <th>Tu</th>
                            <th>We</th>
                            <th>Th</th>
                            <th>Fr</th>
                            <th>Sa</th>
                            <th>Su</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td>25</td>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>30</td>
                            <td>31</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </details>
                </li>
                <li><a href="players_index.php" id="players">Players</a></li>
                <li><button id="button_stadium" type="button">Stadium</button></li>
                <li>
                    <details>
                        <summary> Trophies </summary>
                        <img id="trophies_img" src="/images/torphies2.jfif" alt="Trophies">
                    </details>
                </li>
            </ul>
        </div>

        <div class="col-2">
            <div id="history">
                <h2>The History</h2>
                <p >FOUNDED IN 1878 AS NEWTON HEATH L&YR FOOTBALL CLUB, OUR CLUB HAS OPERATED FOR OVER 140 YEARS. THE TEAM FIRST ENTERED THE ENGLISH FIRST DIVISION, THEN THE HIGHEST LEAGUE IN ENGLISH FOOTBALL, FOR THE START OF THE 1892-93 SEASON. OUR CLUB NAME CHANGED TO MANCHESTER UNITED FOOTBALL CLUB IN 1902, AND WE WON THE FIRST OF OUR 20 ENGLISH LEAGUE TITLES IN 1908. IN 1910, WE MOVED TO OLD TRAFFORD, OUR CURRENT STADIUM.</p>
            </div>
        </div>

        <div class="col-3">
            <div class="aside">
                <h2>Why I choose this team?</h2>
                <p>Manchester United became my favourite team thanks to my grandfather. He had a short career as a footballer and already at the age of 10 he made me passionate about the sport and the team</p>
                <h2>Who is my favourite player now?</h2>
                <p>I love all the players from the team except Marcial - the callous footballer. But still my favorite is Rashford, boy from academy who love the team</p>
                <h2>How many fans does the team have?</h2>
                <p>Of those 1.6 billion followers, 659 million are Manchester united followers with 431 million of them regarded as die hard fans. This means that the amount of Manchester United followers are more than a third of the worldwide football followers and are nearly 10% of the world population</p>
            </div>
        </div>
    </div>

    <footer>
        <button id="button_back">Go back</button>
        <a href="https://tickets.manutd.com/en-GB/categories/home-tickets" target="_blank" class="button"><span>Get ticket </span></a>
    </footer>

    <script src="styles_and_script/index_script.js"></script>
</body>
</html>
