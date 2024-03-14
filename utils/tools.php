<?php

function log_r($message) {
    echo "<hr class='border border-5 border-dark'><pre>" ;
    print_r($message);
    echo "</pre><hr>";
}