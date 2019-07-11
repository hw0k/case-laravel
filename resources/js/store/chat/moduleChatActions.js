/*= ====================================================================================================================================
  File Name: moduleChatActions.js
  Description: Chat Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuesax Admin - VueJS Dashboard Admin Template
  Version: 1.1
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
======================================================================================================================================= */


export default {
    updateAboutChat({ commit }, value) {
        commit('UPDATE_ABOUT_CHAT', value);
    },
    updateStatusChat({ commit }, value) {
        commit('UPDATE_STATUS_CHAT', value);
    },
    setChatSearchQuery({ commit }, query) {
        commit('SET_CHAT_SEARCH_QUERY', query);
    },
    sendChatMessage({ getters, commit }, payload) {
        payload.chatData = getters.chatDataOfUser(payload.id);
        commit('SEND_CHAT_MESSAGE', payload);
    },
    toggleIsPinned({ commit }, payload) {
        commit('TOGGLE_IS_PINNED', payload);
    },
    markSeenAllMessages({ getters, commit }, id) {
        const payload = { id };
        payload.chatData = getters.chatDataOfUser(payload.id);
        commit('MARK_SEEN_ALL_MESSAGES', payload);
    },
};
