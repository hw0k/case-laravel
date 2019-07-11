export default {
    setSurvey({ commit }, payload) {
        commit('SET_SURVEY', payload);
    },
    setTags({ commit }, payload) {
        commit('SET_TAG', payload);
    },
    updateTag({ commit }, payload) {
        commit('TAG_UPDATE_CHECKED', payload);
    },
    applySurveyFilter({ commit }, filterName) {
        commit('APPLY_SURVEY_FILTER', filterName);
    },
    setSurveySearchQuery({ commit }, query) {
        commit('SET_SURVEY_SEARCH_QUERY', query);
    },

    updateAllTag({ commit }, payload) {
        commit('TAG_ALL_UPDATE', payload);
    },
};
