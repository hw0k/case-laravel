
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
        <credit-filter></credit-filter>
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
        ></feather-icon>

        <!-- SEARCH BAR -->
        <vs-input
          size="large"
          icon-pack="feather"
          icon="icon-search"
          placeholder="검색.."
          class="vs-input-no-border vs-input-no-shdow-focus no-icon-border w-full"
        />
      </div>

      <!-- TODO LIST -->
      <VuePerfectScrollbar
        id="creditList"
        class="todo-content-scroll-area vs-con-loading__container"
        :settings="settings"
        ref="todoListPS"
      >
        <credit-item></credit-item>
      </VuePerfectScrollbar>
      <!-- /TODO LIST -->
    </div>
  </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar';
import CreditItem from './ItemGridView.vue';
import CreditFilter from './CreditFilters.vue';

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
    },
    components: {
        CreditFilter,
        CreditItem,
        VuePerfectScrollbar,
    },
    mounted() {
        this.windowWidth = window.innerWidth;
        this.$nextTick(() => {
            window.addEventListener('resize', this.handleWindowResize);
        });
        this.setSidebarWidth();
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleWindowResize);
    },
};
</script>

<style lang="scss">
@import "@/assets/scss/vuesax/apps/todo.scss";
</style>
