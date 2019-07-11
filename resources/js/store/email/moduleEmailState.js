/*= ====================================================================================================================================
  File Name: moduleEmailState.js
  Description: Email Module State
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Version: 1.1
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
======================================================================================================================================= */


export default {
    mails: [],
    mail_filter: 'inbox',
    mailTags: [
        { text: 'Personal', value: 'personal', color: 'success' },
        { text: 'Company', value: 'company', color: 'primary' },
        { text: 'Important', value: 'important', color: 'warning' },
        { text: 'Private', value: 'private', color: 'danger' },
    ],
    mailSearchQuery: '',
};
