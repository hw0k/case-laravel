<template>
  <div class="todo__filters-container">
    <!-- starred -->
    <div class="px-6 py-4">
      <h5>정렬</h5>

      <template v-for="filter in sortFilter">
        <div
          class="flex mt-6 cursor-pointer"
          :class="{ 'text-primary': orderBy === filter.filter }"
          @click="updateOrderBy(filter.filter)"
          :key="filter.filter"
        >
          <feather-icon
            :icon="filter.icon"
            :svgClasses="[
              {
                'text-primary stroke-current': orderBy === filter.filter
              },
              'h-6 w-6'
            ]"
          ></feather-icon>
          <span class="text-lg ml-3">{{ filter.filterName }}</span>
        </div>
      </template>
    </div>

    <vs-divider></vs-divider>

    <div class="px-6 py-4">
      <vs-checkbox
        class="float-right"
        @change="e => $store.dispatch('survey/updateAllTag', e.target.checked)"
        :checked="isAllChecked"
        >전체 선택</vs-checkbox
      >
      <h5>태그</h5>

      <div class="todo__lables-list">
        <div
          class="todo__label flex items-center mt-6 cursor-pointer"
          v-for="(tag, index) in tags"
          :key="index"
        >
          <vs-checkbox
            @change.stop="e => updateCheckState(e, index)"
            :checked="tag.sorted"
          >
            <span class="text-lg">{{ tag.i_interest }}</span>
          </vs-checkbox>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    data() {
        return {
            sortFilter: [
                { filterName: '인기순', filter: 'popular', icon: 'BarChartIcon' },
                { filterName: '최신순', filter: 'recent', icon: 'ClockIcon' },
                { filterName: '가격순', filter: 'price', icon: 'DollarSignIcon' },
            ],
            tagFilter: [],
            sort: 'popular',
        };
    },
    created() {
        this.$http.get('/case/getInterest').then(({ data }) => {
            if (!data) throw new Error('데이터 오류');
            this.$store.dispatch('survey/setTags', data);
        });
    },
    methods: {
        updateCheckState(e, idx) {
            this.$store.dispatch('survey/updateTag', {
                idx,
                value: e.target.checked,
            });
        },
        updateOrderBy(filter) {
            this.$store.dispatch('survey/applySurveyFilter', filter);
        },
    },
    computed: {
        tags() {
            return this.$store.getters['survey/tags'];
        },
        orderBy() {
            return this.$store.getters['survey/surveyOrderBy'];
        },
        isAllChecked() {
            return this.$store.getters['survey/tags'].every(e => e.sorted === true);
        },
    },
};
</script>
