import {extend} from 'flarum/extend';
import app from 'flarum/app';
import MailchimpSettingsModal from './components/MailchimpSettingsModal';

app.initializers.add('clarkwinkelmann-silent-mailchimp', () => {
    app.extensionSettings['clarkwinkelmann-silent-mailchimp'] = () => app.modal.show(new MailchimpSettingsModal());
});
