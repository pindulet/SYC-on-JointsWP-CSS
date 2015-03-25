<?php
function db_connect() {
    //mysql_connect("localhost", "root", "root") or die(mysql_error());
    //mysql_select_db("shareyourcloset_dk_db");
    return mysqli_connect("localhost", "root", "root", "shareyourcloset_dk_db");

}?>
