<template>
  <div class="parentx">
    <vs-sidebar
      ref="mainSidebar"
      :parent="parent"
      :hiddenBackground="true"
      :reduce="reduce"
      default-index="-1"
      class="sidebarx main-menu-sidebar items-no-padding"
      v-model="isSidebarActive"
      :click-not-close="clickNotClose"
      :reduce-not-rebound="reduceNotRebound"
    >
      <div @mouseenter="sidebarMouseEntered" @mouseleave="sidebarMouseLeave">
        <div
          class="header-sidebar flex items-end justify-between"
          slot="header"
        >
          <div class="logo flex items-center">
            <img :src="logo" alt="logo" class="w-10 mr-4" v-if="logo" />
            <span
              class="logo-text"
              v-show="isMouseEnter || !reduce"
              v-if="title"
              >{{ title }}</span
            >
          </div>
          <div>
            <fragment v-if="showCloseButton">
              <feather-icon
                icon="XIcon"
                class="m-0 cursor-pointer"
                @click="$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', false)"
              />
            </fragment>
            <fragment v-else-if="!showCloseButton && !sidebarItemsMin">
              <feather-icon
                icon="DiscIcon"
                class="mr-0 cursor-pointer"
                svg-classes="stroke-current"
                v-show="!reduce"
                @click="toggleReduce(true)"
              ></feather-icon>
              <feather-icon
                icon="CircleIcon"
                class="mr-0 cursor-pointer"
                svg-classes="stroke-current"
                v-show="reduce"
                @click="toggleReduce(false)"
              ></feather-icon>
            </fragment>
          </div>
        </div>

        <div class="shadow-bottom" v-show="showShadowBottom"></div>

        <VuePerfectScrollbar
          ref="mainSidebarPs"
          class="scroll-area--main-sidebar pt-2"
          :settings="settings"
          @ps-scroll-y="psSectionScroll"
        >
          <fragment v-for="(sidebarItem, index) in sidebarItems" :key="index">
            <span
              :key="`header-${index}`"
              v-if="sidebarItem.header && !sidebarItemsMin"
              class="navigation-header truncate"
              >{{ sidebarItem.header }}</span
            >
            <fragment v-else-if="!sidebarItem.header">
              <vx-sidebar-item
                ref="sidebarLink"
                :key="`sidebarItem-${index}`"
                v-if="!sidebarItem.submenu"
                :index="index"
                :to="sidebarItem.slug != 'external' ? sidebarItem.url : ''"
                :href="sidebarItem.slug == 'external' ? sidebarItem.url : ''"
                :icon="sidebarItem.icon"
                :target="sidebarItem.target"
                :isDisabled="sidebarItem.isDisabled"
              >
                <span v-show="!sidebarItemsMin" class="truncate">{{
                  sidebarItem.name
                }}</span>
                <vs-chip
                  class="ml-auto"
                  :color="sidebarItem.tagColor"
                  v-if="sidebarItem.tag && (isMouseEnter || !reduce)"
                  >{{ sidebarItem.tag }}</vs-chip
                >
              </vx-sidebar-item>
              <fragment v-else>
                <vx-sidebar-group
                  ref="sidebarGrp"
                  :key="`group-${index}`"
                  :openHover="openGroupHover"
                  :group="sidebarItem"
                  :groupIndex="index"
                  :open="isGroupActive(sidebarItem)"
                ></vx-sidebar-group>
              </fragment>
            </fragment>
          </fragment>
        </VuePerfectScrollbar>
      </div>
    </vs-sidebar>
  </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar';
import VxSidebarGroup from './CaseSidebarGroup.vue';
import VxSidebarItem from './CaseSidebarItem.vue';

export default {
    name: 'case-sidebar',
    props: {
        sidebarItems: {
            type: Array,
            required: true,
        },
        title: {
            type: String,
        },
        logo: {
            type: String,
        },
        parent: {
            type: String,
        },
        openGroupHover: {
            type: Boolean,
            default: false,
        },
        reduceNotRebound: {
            type: Boolean,
            default: true,
        },
    },
    data: () => ({
        clickNotClose: false, // disable close sidebar on outside click
        reduce: false, // determines if sidebar is reduce - component property
        showCloseButton: false, // show close button in smaller devices
        isMouseEnter: false,
        settings: {
            // perfectscrollbar settings
            maxScrollbarLength: 60,
            wheelSpeed: 1,
            swipeEasing: true,
        },
        windowWidth: null, // width of windows
        showShadowBottom: false,
    }),
    computed: {
        isSidebarActive: {
            get() {
                return this.$store.state.isSidebarActive;
            },
            set() {},
        },
        reduceSidebar() {
            return Boolean(this.reduce && this.reduceButton);
        },
        reduceButton: {
            get() {
                return this.$store.state.reduceButton;
            },
            set(val) {
                this.$store.commit('TOGGLE_REDUCE_BUTTON', val);
            },
        },
        sidebarItemsMin() {
            return this.$store.state.sidebarItemsMin;
        },
        isGroupActive() {
            return (sidebarItem) => {
                const path = this.$route.fullPath;
                let open = false;
                const func = function (sItem) {
                    if (sItem.submenu) {
                        sItem.submenu.forEach((item) => {
                            if (path === item.url) {
                                open = true;
                            } else if (item.submenu) {
                                func(item);
                            }
                        });
                    }
                };
                func(sidebarItem);
                return open;
            };
        },
    },
    watch: {
        reduce(val) {
            if (val === true) {
                this.$store.dispatch('updateSidebarWidth', 'reduced');
            } else {
                this.$store.dispatch('updateSidebarWidth', 'default');
            }

            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 100);
        },
        reduceButton() {
            this.setSidebarWidth();
        },
        $route() {
            if (this.isSidebarActive && this.showCloseButton) {
                this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', false);
            }
        },
    },
    methods: {
        sidebarMouseEntered() {
            if (this.reduce) this.$store.commit('UPDATE_SIDEBAR_ITEMS_MIN', false);
            this.isMouseEnter = true;
        },
        sidebarMouseLeave() {
            if (this.reduce) {
                this.$store.commit('UPDATE_SIDEBAR_ITEMS_MIN', true);
            }
            this.isMouseEnter = false;
        },
        toggleReduce(val) {
            this.reduceButton = val;
            this.setSidebarWidth();
        },
        handleWindowResize(event) {
            this.windowWidth = event.currentTarget.innerWidth;
            this.setSidebarWidth();
        },
        setSidebarWidth() {
            if (this.windowWidth < 1200) {
                if (this.windowWidth < 992) {
                    this.$store.commit('UPDATE_WINDOW_BREAKPOINT', 'md');
                } else this.$store.commit('UPDATE_WINDOW_BREAKPOINT', 'lg');

                this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', false);
                if (this.reduceButton) this.reduce = false;
                // this.reduceButton = false;
                this.showCloseButton = true;
                this.clickNotClose = false;
                this.$store.dispatch('updateSidebarWidth', 'no-sidebar');
                this.$store.commit('UPDATE_SIDEBAR_ITEMS_MIN', false);
            } else {
                this.$store.commit('UPDATE_WINDOW_BREAKPOINT', 'xl');
                if (this.reduceButton) this.reduce = true;
                else this.reduce = false;

                this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', true);
                if (this.reduceButton && !this.isMouseEnter) {
                    this.$store.commit('UPDATE_SIDEBAR_ITEMS_MIN', true);
                } else this.$store.commit('UPDATE_SIDEBAR_ITEMS_MIN', false);

                this.clickNotClose = true;
                this.showCloseButton = false;
                if (this.reduceSidebar) {
                    this.$store.dispatch('updateSidebarWidth', 'reduced');
                } else this.$store.dispatch('updateSidebarWidth', 'default');
            }
        },
        psSectionScroll() {
            if (this.$refs.mainSidebarPs.$el.scrollTop > 0) {
                this.showShadowBottom = true;
            } else this.showShadowBottom = false;
        },
    },
    components: {
        VxSidebarGroup,
        VxSidebarItem,
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
@import "@/assets/scss/vuesax/components/vxSidebar.scss";
</style>
