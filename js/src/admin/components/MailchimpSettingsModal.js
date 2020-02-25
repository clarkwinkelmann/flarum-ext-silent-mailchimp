import app from 'flarum/app';
import SettingsModal from 'flarum/components/SettingsModal';
import Select from 'flarum/components/Select';

/* global m */

const settingsPrefix = 'clarkwinkelmann-silent-mailchimp.';
const translationPrefix = 'clarkwinkelmann-silent-mailchimp.admin.settings.';

export default class MailchimpSettingsModal extends SettingsModal {
    title() {
        return app.translator.trans(translationPrefix + 'title');
    }

    form() {
        return [
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'api-key')),
                m('input.FormControl', {
                    type: 'text',
                    bidi: this.setting(settingsPrefix + 'apiKey'),
                    placeholder: '0123456789abcdef0123456789abcdef-us0',
                }),
                m('.helpText', app.translator.trans(translationPrefix + 'api-key-help', {
                    a: m('a', {
                        href: 'https://us1.admin.mailchimp.com/account/api/',
                    }),
                })),
            ]),
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'list-id')),
                m('input.FormControl', {
                    type: 'text',
                    bidi: this.setting(settingsPrefix + 'listId'),
                    placeholder: '12345abcde',
                }),
                m('.helpText', app.translator.trans(translationPrefix + 'list-id-help', {
                    a: m('a', {
                        href: 'https://us1.admin.mailchimp.com/lists/',
                    }),
                })),
            ]),
            m('.Form-group', [
                m('label', app.translator.trans(translationPrefix + 'when')),
                Select.component({
                    options: {
                        activated: app.translator.trans(translationPrefix + 'when-options.activated'),
                        registered: app.translator.trans(translationPrefix + 'when-options.registered'),
                    },
                    value: this.setting(settingsPrefix + 'when')() || 'activated',
                    onchange: this.setting(settingsPrefix + 'when'),
                }),
            ]),
        ];
    }
}
