<?php

/**
 * Renders a plain logout button.
 *
 * @return void
 */
function logoutButton(): void
{
    if (isset($_SESSION['haikoshi'])) {
        echo '&nbsp;&nbsp;<a class="styled-button-1" accessKey="l" href="logout.php">🦺 Logout</a>';
    }
}

/**
 * Renders whole HTML-page header with the given title.
 *
 * @param $title string if the title is empty the application name is rendered, otherwise 'app name - given title'.
 *
 * @return void
 */
function pageHeader($title): void
{
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="stylesheet" href="style.css">';
    echo '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">';
    echo '<link rel="manifest" href="/site.webmanifest">';

    if (empty($title)) {
        echo '<title>Haikoshi</title>';
    } else {
        echo '<title>Haikoshi - '.$title.'</title>';
    }
    echo '</head>';
}
