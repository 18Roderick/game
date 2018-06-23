<?php
$user = $_REQUEST['user'];

if ($user != 'rjrr507') {
    echo "<span class='succes'>  disponible </span>";
} else {
    echo "<span class='warning'>  ya esta en uso</span>";
}
