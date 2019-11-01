<?php

namespace Src;

class View {

    static function render($template, $data = NULL)
    {
        $path = str_replace('.', '/', $template);
        include sprintf(__DIR__.'/../app/templates/%s.php', $path);
    }
}