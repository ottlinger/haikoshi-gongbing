<?php

function logoutButton()
{
    if (isset($_SESSION['haikoshi'])) {
        echo '&nbsp;&nbsp;<a class="styled-button-1" accessKey="l" href="logout.php">🦺 Logout</a>';
    }

}
