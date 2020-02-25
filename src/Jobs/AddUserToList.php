<?php

namespace ClarkWinkelmann\SilentMailchimp\Jobs;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

class AddUserToList implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        /**
         * @var $settings SettingsRepositoryInterface
         */
        $settings = app(SettingsRepositoryInterface::class);

        $apiKey = $settings->get('clarkwinkelmann-silent-mailchimp.apiKey');

        if (!Str::contains($apiKey, '-')) {
            /**
             * @var $logger LoggerInterface
             */
            $logger = app(LoggerInterface::class);
            $logger->error('[silent-mailchimp] Invalid API key');

            return;
        }

        // The datacenter prefix is at the end of the API Key
        $dataCenter = explode('-', $apiKey)[1];

        $client = new Client([
            'base_uri' => "https://$dataCenter.api.mailchimp.com/3.0/",
            'auth' => [
                'anyname', // The username is not actually used by Mailchimp
                $apiKey,
            ],
        ]);

        $listId = $settings->get('clarkwinkelmann-silent-mailchimp.listId');

        try {
            // Mailchimp documentation https://mailchimp.com/developer/reference/lists/list-members/
            $client->post("lists/$listId/members", [
                'json' => [
                    'email_address' => $this->user->email,
                    'status' => 'subscribed',
                ],
            ]);
        } catch (\Exception $exception) {
            /**
             * @var $logger LoggerInterface
             */
            $logger = app(LoggerInterface::class);
            $logger->error('[silent-mailchimp] ' . $exception->getMessage());
        }
    }
}
