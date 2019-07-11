
<template>
  <div
    id="todo-app"
    class="border border-solid d-theme-border-grey-light rounded relative overflow-hidden"
  >
    <vs-sidebar
      class="items-no-padding"
      parent="#todo-app"
      :click-not-close="clickNotClose"
      :hidden-background="clickNotClose"
      v-model="isSidebarActive"
    >
      <!-- <todo-add-new></todo-add-new> -->
      <VuePerfectScrollbar class="todo-scroll-area" :settings="settings">
        <survey-filter @closeSidebar="toggleSurveySidebar"></survey-filter>
      </VuePerfectScrollbar>
    </vs-sidebar>

    <div
      :class="{ 'sidebar-spacer': clickNotClose }"
      class="app-fixed-height border border-r-0 border-b-0 border-t-0 border-solid d-theme-border-grey-light app-fixed-height"
    >
      <div
        class="flex items-center app-search-container border border-l-0 border-r-0 border-t-0 border-solid d-theme-border-grey-light"
      >
        <!-- TOGGLE SIDEBAR BUTTON -->
        <feather-icon
          class="md:inline-flex lg:hidden ml-4 mr-4 cursor-pointer"
          icon="MenuIcon"
          @click.stop="toggleSurveySidebar(true)"
        ></feather-icon>

        <!-- SEARCH BAR -->
        <vs-input
          size="large"
          icon-pack="feather"
          icon="icon-search"
          placeholder="검색.."
          v-model="searchQuery"
          class="vs-input-no-border vs-input-no-shdow-focus no-icon-border w-full"
        />
      </div>

      <!-- TODO LIST -->
      <VuePerfectScrollbar
        id="surveyList"
        class="todo-content-scroll-area vs-con-loading__container"
        :settings="settings"
        ref="todoListPS"
      >
        <transition-group
          class="todo-list"
          name="list-enter-up"
          tag="ul"
          appear
        >
          <li
            class="cursor-pointer todo_todo-item"
            v-for="(surveyItem, index) in survey"
            :key="String(orderBy) + String(surveyItem.ca_idx)"
            :style="[{ transitionDelay: index * 0.1 + 's' }]"
          >
            <survey-item :survey="surveyItem"></survey-item>
          </li>
        </transition-group>
      </VuePerfectScrollbar>
      <!-- /TODO LIST -->
    </div>

    <!-- EDIT TODO DIALOG -->
    <!-- <todo-edit -->
    <!-- :displayPrompt="displayPrompt" -->
    <!-- :todoItemId="todoIdToEdit" -->
    <!-- @hideDisplayPrompt="hidePrompt" -->
    <!-- v-if="displayPrompt" -->
    <!-- ></todo-edit> -->
  </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar';
import SurveyItem from './SurveyItem.vue';
import SurveyFilter from './SurveyFilters.vue';

export default {
    data() {
        return {
            clickNotClose: true,
            isSidebarActive: true,
            windowWidth: null,
            settings: {
                maxScrollbarLength: 60,
                wheelSpeed: 0.30,
            },
        };
    },
    watch: {
        orderBy() {
            this.$refs.todoListPS.$el.scrollTop = 0;
        },
    },
    computed: {
        survey() {
            return this.$store.getters['survey/surveyList'];
        },
        orderBy() {
            return this.$store.state.survey.orderBy;
        },
        searchQuery: {
            get() {
                return this.$store.state.survey.surveySearchQuery;
            },
            set(val) {
                this.$store.dispatch('survey/setSurveySearchQuery', val);
            },
        },
    },
    methods: {
        handleWindowResize(event) {
            this.windowWidth = event.currentTarget.innerWidth;
            this.setSidebarWidth();
        },
        setSidebarWidth() {
            if (this.windowWidth < 992) {
                this.isSidebarActive = false;
                this.clickNotClose = false;
            } else {
                this.isSidebarActive = true;
                this.clickNotClose = true;
            }
        },
        toggleSurveySidebar(value = false) {
            if (!value && this.clickNotClose) return;
            this.isSidebarActive = value;
        },
    },
    components: {
        SurveyItem,
        SurveyFilter,
        VuePerfectScrollbar,
    },
    mounted() {
        this.windowWidth = window.innerWidth;
        this.$nextTick(() => {
            window.addEventListener('resize', this.handleWindowResize);
        });
        this.setSidebarWidth();
        this.$vs.loading({
            container: this.$refs.todoListPS.$el,
            scale: 2,
        });
        this.$http.get('/case')
            .then((response) => {
                const { data } = response;
                this.$store.dispatch('survey/setSurvey', data);
                this.$vs.loading.close(this.$refs.todoListPS.$el);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleWindowResize);
    },
};
</script>

<style lang="scss">
@import "@/assets/scss/vuesax/apps/todo.scss";
</style>
