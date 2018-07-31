<?php
if(isset($_SESSION['login']))
{
    echo "<header><ul><li class='main_navigation_li'><a id='home_link' href='home'>HOME</a></li><li class='main_navigation_li'><a id='users_link' href='users'>USERS</a></li><li class='main_navigation_li'><a id='user_link' href='user'>USER</a></li><li class='main_navigation_li'><a id='log_out_link' href='process'>LOG OUT</a></li></ul></header>";
}
else
{
    echo "<header><ul><li class='main_navigation_li'><a id='home_link' href='home'>HOME</a></li><li class='main_navigation_li'><a id='login_link' href='login'>LOGIN</a></li<li class='main_navigation_li'><a id='registration_link' href='registration'>REGISTER</a></li></ul></header>";
}

?>
<!--
<header>
    <ul>
        <li class="main_navigation_li"><a id="home_link" href="home">HOME</a></li>
        <li class="main_navigation_li"><a id="users_link" href="users">USERS</a></li>
        <li class="main_navigation_li"><a id="user_link" href="user">USER</a></li>
        <li class="main_navigation_li"><a id="login_link" href="login">LOGIN</a></li>
        <li class="main_navigation_li"><a id="registration_link" href="registration">REGISTRATION</a></li>
    </ul>
</header>

-->
<main><span>MAIN</span></main>
<footer>FOOTER</footer>



