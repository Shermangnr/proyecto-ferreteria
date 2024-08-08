<?php
$password = '12345'; // Reemplaza 'tu_contraseña' con la contraseña que deseas hashear
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;