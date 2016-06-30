<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  shell_exec( 'cd /var/www/html/ && git reset --hard HEAD && git pull https://luokerenx:qingheyikan89@github.com/luokerenz/lightsama 2>&1' );
}

?>
