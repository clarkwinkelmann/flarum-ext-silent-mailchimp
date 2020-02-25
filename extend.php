<?php

namespace ClarkWinkelmann\SilentMailchimp;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    new Extenders\AddNewUsersToList(),
];
