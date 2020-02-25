<?php

namespace ClarkWinkelmann\SilentMailchimp\Extenders;

use ClarkWinkelmann\SilentMailchimp\Jobs\AddUserToList;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Event\Activated;
use Flarum\User\Event\Registered;
use Flarum\User\User;
use Illuminate\Contracts\Container\Container;

class AddNewUsersToList implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        $container->make('events')->listen(Activated::class, [$this, 'activated']);
        $container->make('events')->listen(Registered::class, [$this, 'registered']);
    }

    public function activated(Activated $event)
    {
        if (!$this->whenRegistered()) {
            $this->pushToQueue($event->user);
        }
    }

    public function registered(Registered $event)
    {
        if ($this->whenRegistered()) {
            $this->pushToQueue($event->user);
        }
    }

    protected function whenRegistered()
    {
        /**
         * @var $settings SettingsRepositoryInterface
         */
        $settings = app(SettingsRepositoryInterface::class);

        return $settings->get('clarkwinkelmann-silent-mailchimp.when') === 'registered';
    }

    protected function pushToQueue(User $user)
    {
        app('flarum.queue.connection')->push(
            new AddUserToList($user)
        );
    }
}
