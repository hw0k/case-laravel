<template>
  <div class="todo__filters-container" >
    <!-- starred -->
    <div class="px-6 py-4">
      <h5>정렬</h5>

      <template v-for="filter in sortFilter">
        <div
          class="flex mt-6 cursor-pointer"
          :class="{ 'text-primary': filter.filterName === '최신순'}"
          :key="filter.filter"
        >
          <feather-icon
            :icon="filter.icon"
          ></feather-icon>
          <span class="text-lg ml-3">{{ filter.filterName }}</span>
        </div>
      </template>
    </div>

    <vs-divider></vs-divider>

    <div class="px-6 py-4">

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
            sort: 'popular',
        };
    },
};
</script>
