# Silent Mailchimp

[![MIT license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/clarkwinkelmann/flarum-ext-silent-mailchimp/blob/master/LICENSE.md) [![Latest Stable Version](https://img.shields.io/packagist/v/clarkwinkelmann/flarum-ext-silent-mailchimp.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-silent-mailchimp) [![Total Downloads](https://img.shields.io/packagist/dt/clarkwinkelmann/flarum-ext-silent-mailchimp.svg)](https://packagist.org/packages/clarkwinkelmann/flarum-ext-silent-mailchimp) [![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.me/clarkwinkelmann)

This extensions silently adds new Flarum users to a Mailchimp list.

The intent is to use it with Mailchimp's automated workflows, not newsletters.

There are no settings for the users. Admins can customize the API Key and List ID in the admin panel.

You can choose between adding users after email validation (default) or immediately after registration.
For social login either option will trigger at the same time.

The extension is compatible with queues.

## Installation

    composer require clarkwinkelmann/flarum-ext-silent-mailchimp

## Links

- [GitHub](https://github.com/clarkwinkelmann/flarum-ext-silent-mailchimp)
- [Packagist](https://packagist.org/packages/clarkwinkelmann/flarum-ext-silent-mailchimp)
