export default {
    surveyArrayLength: state => state.surveyArray.length,
    surveyList: state => state.surveyArray.filter((item) => {
        console.log('filter');
        if (item.tags.filter(tag => state.tags.filter(f => f.sorted).map(t => t.i_idx).indexOf(tag.i_idx) > -1).length > 0) {
            if (item.ca_title.indexOf(state.surveySearchQuery) > -1) { return true; }
        }
    }).sort((a, b) => {
        if (state.orderBy === 'popular') {
            return a.ca_participant > b.ca_participant ? -1 : 1;
        }
        if (state.orderBy === 'recent') {
            return new Date(a.ca_created).getTime() > new Date(b.ca_created).getTime() ? -1 : 1;
        }
        if (state.orderBy === 'price') {
            return a.ca_point > b.ca_point ? -1 : 1;
        }
    }),
    getSurveyBySection: state => sectionId => state.todoArray.filter(todoItem => todoItem.sectionId === sectionId),
    tags: state => state.tags,
    surveyOrderBy: state => state.orderBy,
};
