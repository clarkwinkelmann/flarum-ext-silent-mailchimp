<?php

namespace ClarkWinkelmann\SilentMailchimp\Extenders;

use ClarkWinkelmann\SilentMailchimp\Jobs\AddUserToList;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\User\Event\Registered;
use Illuminate\Contracts\Container\Container;

class AddNewUsersToList implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container->make('events')->listen(Registered::class, [$this, 'registered']);
    }

    public function registered(Registered $event)
    {
        app('flarum.queue.connection')->push(
            new AddUserToList($event->user)
        );
    }
}
