<?php
error_reporting(error_level: E_ALL & ~E_DEPRECATED & ~E_STRICT);
use App\Kernel;
require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    
};
