/*= ====================================================================================================================================
  File Name: moduleTodo.js
  Description: Todo Module
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Version: 1.1
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
======================================================================================================================================= */


import state from './moduleTodoState';
import mutations from './moduleTodoMutations';
import actions from './moduleTodoActions';
import getters from './moduleTodoGetters';

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
