<?php

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', '\phpngaos\Controller\Welcome@indexHandler');
    $r->addRoute('POST', '/', '\phpngaos\Controller\Welcome@handleUpload');

    // {id} must be a number (\d+)
    $r->addRoute('GET', '/user/{id:\d+}', '\phpngaos\Controller\WelcomeController@indexHandler');

    // The /{title} suffix is optional
    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});
