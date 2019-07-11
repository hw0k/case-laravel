<template>
  <div
    class="layout--main"
    :class="[navbarClasses, footerClasses, { 'app-page': isAppPage }]"
  >
    <case-sidebar
      :sidebarItems="sidebarItems"
      title="Case"
      parent=".layout--main"
    />

    <div
      id="content-area"
      :class="[contentAreaClass, { 'show-overlay': bodyOverlay }]"
    >
      <div id="content-overlay"></div>

      <div class="content-wrapper">
        <case-header
          :navbarColor="navbarColor"
          :class="[
            { 'text-white': isNavbarDark && !isThemeDark },
            { 'text-base': !isNavbarDark && isThemeDark }
          ]"
        />

        <div class="router-view">
          <div
            class="router-content"
            :class="{ 'mt-0': navbarType == 'hidden' }"
          >
            <transition :name="routerTransition">
              <div
                class="router-header flex flex-wrap items-center mb-6"
                v-if="$route.meta.breadcrumb || $route.meta.pageTitle"
              >
                <div
                  class="content-area__heading"
                  :class="{
                    'pr-4 border-0 md:border-r border-t-0 border-b-0 border-l-0 border-solid border-grey-light':
                      $route.meta.breadcrumb
                  }"
                >
                  <h2 class="mb-1">{{ routeTitle }}</h2>
                </div>
                <case-breadcrumb
                  class="ml-4 md:block hidden"
                  v-if="$route.meta.breadcrumb"
                />
                <!--  현재 사용 안함
                <vs-dropdown class="ml-auto md:block hidden" vs-trigger-click>
                  <vs-button
                    radius
                    icon="icon-settings"
                    icon-pack="feather"
                  ></vs-button>
                  <vs-dropdown-menu class="w-32">
                    <vs-dropdown-item
                      ><router-link
                        to="/pages/profile"
                        class="flex items-center"
                        ><feather-icon
                          icon="UserIcon"
                          class="inline-block mr-2"
                          svgClasses="w-4 h-4"
                        /><span>Profile</span></router-link
                      ></vs-dropdown-item
                    >
                    <vs-dropdown-item
                      ><router-link to="/apps/todo" class="flex items-center"
                        ><feather-icon
                          icon="CheckSquareIcon"
                          class="inline-block mr-2"
                          svgClasses="w-4 h-4"
                        /><span>Tasks</span></router-link
                      ></vs-dropdown-item
                    >
                    <vs-dropdown-item
                      ><router-link to="/apps/email" class="flex items-center"
                        ><feather-icon
                          icon="MailIcon"
                          class="inline-block mr-2"
                          svgClasses="w-4 h-4"
                        /><span>Inbox</span></router-link
                      ></vs-dropdown-item
                    >
                  </vs-dropdown-menu>
                </vs-dropdown>
                -->
              </div>
            </transition>
            <div class="content-area__content">
              <transition :name="routerTransition" mode="out-in">
                <router-view @changeRouteTitle="changeRouteTitle"></router-view>
              </transition>
            </div>
          </div>
        </div>
      </div>

      <!-- <the-footer></the-footer> -->
    </div>
  </div>
</template>

<script>
import CaseSidebar from './components/sidebar/CaseSidebar.vue';
import CaseHeader from './components/header/CaseHeader.vue';
import CaseBreadcrumb from './components/breadcrumb/CaseBreadcrumb.vue';
import sidebarItems from '../sidebarItem';

export default {
    data() {
        return {
            navbarType: 'sticky',
            navbarColor: '#fff',
            footerType: 'static',
            routerTransition: 'none',
            isNavbarDark: false,
            routeTitle: this.$route.meta.pageTitle,
            sidebarItems,
            windowWidth: null,
        };
    },
    watch: {
        $route() {
            this.routeTitle = this.$route.meta.pageTitle;
        },
        isThemeDark(val) {
            if (this.navbarColor === '#fff' && val) {
                this.updateNavbarColor('#10163a');
            } else {
                this.updateNavbarColor('#fff');
            }
        },
    },
    computed: {
        isAppPage() {
            if (this.$route.path.includes('/apps/')) return true;
            return false;
        },
        isThemeDark() {
            return this.$store.state.theme === 'dark';
        },
        sidebarWidth() {
            return this.$store.state.sidebarWidth;
        },
        bodyOverlay() {
            return this.$store.state.bodyOverlay;
        },
        contentAreaClass() {
            if (this.sidebarWidth === 'default') return 'content-area-default';
            if (this.sidebarWidth === 'reduced') return 'content-area-reduced';
            return 'content-area-full';
        },
        navbarClasses() {
            return {
                'navbar-hidden': this.navbarType === 'hidden',
                'navbar-sticky': this.navbarType === 'sticky',
                'navbar-static': this.navbarType === 'static',
                'navbar-floating': this.navbarType === 'floating',
            };
        },
        footerClasses() {
            return {
                'footer-hidden': this.footerType === 'hidden',
                'footer-sticky': this.footerType === 'sticky',
                'footer-static': this.footerType === 'static',
            };
        },
    },
    methods: {
        changeRouteTitle(title) {
            this.routeTitle = title;
        },
        updateNavbar(val) {
            this.navbarType = val;
        },
        updateNavbarColor(val) {
            this.navbarColor = val;
            if (val === '#fff') this.isNavbarDark = false;
            else this.isNavbarDark = true;
        },
        updateFooter(val) {
            this.footerType = val;
        },
        updateRouterTransition(val) {
            this.routerTransition = val;
        },
        handleWindowResize(event) {
            this.windowWidth = event.currentTarget.innerWidth;
            this.setSidebarWidth();
        },
        setSidebarWidth() {
            if (this.windowWidth < 1200) {
                this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', false);
                this.$store.dispatch('updateSidebarWidth', 'no-sidebar');
            } else if (this.windowWidth < 1200) {
                this.$store.dispatch('updateSidebarWidth', 'reduced');
            } else {
                this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', true);
            }
        },
    },
    mounted() {
        this.windowWidth = window.innerWidth;
        this.setSidebarWidth();
        if (this.navbarColor === '#fff' && this.isThemeDark) {
            this.updateNavbarColor('#10163a');
        } else {
            this.updateNavbarColor(this.navbarColor);
        }
    },
    components: {
        CaseSidebar,
        CaseHeader,
        CaseBreadcrumb,
    },
};
</script>
