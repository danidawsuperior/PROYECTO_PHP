<?php

if (isset($_COOKIE["nombre"])) {
    setcookie("nombre", "Pepito Conejo", time()-60);
    print "<p>Su nombre es $_COOKIE[nombre]</p>\n";
} else {
    setcookie("nombre", "Pepito Conejo", time()+120);
    print "<p>No sé su nombre.</p>\n";
}
?>