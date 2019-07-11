<template>
  <div
    @click="$emit('displayInfo', survey)"
    class="px-4 py-4 list-item-component"
  >
    <div class="vx-row">
      <div
        class="vx-col w-full sm:w-5/6 flex sm:items-center sm:flex-row flex-col"
      >
        <div class="flex items-center">
          <h5 class="todo-title">
            {{ title }}
          </h5>
        </div>
        <div class="todo-tags sm:ml-2 sm:my-0 my-2 flex">
          <vs-chip
            v-for="(tag, index) in tags"
            :key="index"
            @click="() => onTagClick(tag.i_idx)"
            closable
            close-icon="search"
          >
            <div class="h-2 w-2 rounded-full mr-1" :class="'bg-primary'"></div>
            <span>{{ tag.i_interest }}</span>
          </vs-chip>
        </div>
      </div>
      <div class="vx-col w-full sm:w-1/6 ml-auto flex sm:justify-end">
        <vs-tooltip :text="time_default">
          <span class="text-grey">{{ time }}에 생성</span>
        </vs-tooltip>
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full">
        <p class="mt-2 truncate">
          {{ desc }}
        </p>
      </div>
    </div>
    <vs-divider />
    <div class="vx-row">
      <div class="vx-col w-full flex justify-between">
        <span class="flex items-center">
          <feather-icon icon="UsersIcon" svgClasses="h-5 w-5" />
          <span class="ml-1">{{ participants }}명 참가</span>
        </span>
        <span class="flex items-center">
          <vs-icon icon="money" color="warning" size="small" />
          <span class="ml-1">{{ reward }}원 지급</span>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import ko from 'date-fns/locale/ko';
import distance from 'date-fns/distance_in_words_strict';

export default {
    props: ['survey'],
    data() {
        return {
        };
    },
    methods: {
        onTagClick(idx) {
            this.$store.dispatch('survey/updateAllTag', false);
            this.$store.dispatch('survey/updateTag', {
                idx: this.$store.state.survey.tags.findIndex(tf => tf.i_idx === idx),
                value: true,
            });
        },
    },
    computed: {
        title() {
            return this.survey.ca_title;
        },
        desc() {
            return this.survey.ca_content;
        },
        tags() {
            return this.survey.tags.map(t => this.$store.state.survey.tags.find(tf => tf.i_idx === t.i_idx));
        },
        time() {
            return distance(new Date(), new Date(this.survey.ca_created), { locale: ko, addSuffix: true });
        },
        reward() {
            return this.survey.ca_point;
        },
        participants() {
            return this.survey.ca_participant;
        },
        time_default() {
            return new Date(this.survey.ca_created).toLocaleString();
        },
    },
};
</script>
