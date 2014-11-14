<?php
namespace {
    require './vendor/autoload.php';
}


namespace Buttress\IRC\Connection {
    function fsockopen($ip, $port = null) {
        return fopen('php://temp', 'rw');
    }
}
