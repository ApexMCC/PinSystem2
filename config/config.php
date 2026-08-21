<?php

// default PIN (1200) - used until you change it on the admin page
$config['default_pin_hash'] = '$2y$12$QXHUszjBRLDsJIe7pDyTVuBG3fFole0oTtEdpUOzQiPNS99.hihtO';

// the current pin hash gets saved here when you change it
$config['pin_hash_file'] = __DIR__ . '/pin.hash';

$config['session_name'] = 'apex_basic_pin';
$config['session_days'] = 30;