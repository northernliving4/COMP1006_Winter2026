<?php
session_start();

function loadAdmins() {
    return include __DIR__ . "/data/admins.php";
}

function saveAdmins($admins) {
    file_put_contents(__DIR__ . "/data/admins.php",
        "<?php\nreturn " . var_export($admins, true) . ";"
    );
}

function loadImages() {
    return include __DIR__ . "/data/images.php";
}

function saveImages($images) {
    file_put_contents(__DIR__ . "/data/images.php",
        "<?php\nreturn " . var_export($images, true) . ";"
    );
}
