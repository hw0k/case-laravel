/*= ====================================================================================================================================
  File Name: moduleChat.js
  Description: Chat Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Version: 1.1
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
======================================================================================================================================= */


import state from './moduleChatState';
import mutations from './moduleChatMutations';
import actions from './moduleChatActions';
import getters from './moduleChatGetters';

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
