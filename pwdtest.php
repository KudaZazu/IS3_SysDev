<?php

$hash_default_salt = password_hash("kenny",
PASSWORD_DEFAULT, array('cost' => 9));

echo "$hash_default_salt";

?>