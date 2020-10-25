<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // сервер возвращает файлы напрямую.
} else {
    $rquri = (empty($_SERVER["REQUEST_URI"]) ? '/' : $_SERVER["REQUEST_URI"]);
    switch ($rquri) {
        case '/ping':
        case '/ping/':
            header('Content-Type: text/plain; charset=UTF-8', true, 200);
            echo 'pong';
            return true;
            break;
        case '/health':
        case '/health/':
        case '/healthz':
        case '/healthz/':
            header('Content-Type: application/json; charset=UTF-8', true, 200);
            echo '{"status": "OK"}';
            return true;
            break;
        default:
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', true, 404);
            printf('"%s" does not exist', $_SERVER['REQUEST_URI']);
            return true;
            break;
    }
}