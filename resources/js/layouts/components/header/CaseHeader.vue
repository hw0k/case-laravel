<template>
  <div class="relative">
    <div class="vx-navbar-wrapper">
      <vs-navbar
        class="vx-navbar navbar-custom"
        :color="navbarColor"
        :class="classObj"
      >
        <!-- SM - OPEN SIDEBAR BUTTON -->
        <feather-icon
          class="sm:inline-flex xl:hidden cursor-pointer mr-1"
          icon="MenuIcon"
          @click.stop="showSidebar"
        ></feather-icon>

        <!-- <template v-if="breakpoint != 'md'">
        <div class="bookmark-container">
          <feather-icon icon="StarIcon" :svgClasses="['stoke-current text-warning', {'text-white': navbarColor != '#fff'}]" class="cursor-pointer p-2" @click="showBookmarkPagesDropdown = !showBookmarkPagesDropdown" />  <div v-click-outside="outside" class="absolute bookmark-list w-1/3 xl:w-1/4 mt-4" v-if="showBookmarkPagesDropdown">
            <case-auto-suggest :autoFocus="true" :data="navbarSearchAndPinList" @selected="selected" @actionClicked="actionClicked" inputClassses="w-full" show-action show-pinned background-overlay></case-auto-suggest>
          </div>
        </div>
      </template> -->

        <vs-spacer></vs-spacer>

        <!-- NOTIFICATIONS -->
        <!-- <vs-dropdown vs-custom-content vs-trigger-click>
        <feather-icon icon="BellIcon" class="cursor-pointer mx-6 mt-1" :badge="unreadNotifications.length"></feather-icon>
        <vs-dropdown-menu class="notification-dropdown">
          <div class="notification-top text-center p-5 bg-primary text-white">
            <h3 class="text-white">{{ unreadNotifications.length }} New</h3>
            <p class="opacity-75">App Notifications</p>
          </div>
          <VuePerfectScrollbar ref="mainSidebarPs" class="scroll-area--nofications p-0" :settings="settings">
          <ul class="bordered-items">
            <li v-for="ntf in unreadNotifications" :key="ntf.index" class="flex justify-between px-4 py-4 notification cursor-pointer">
              <div class="flex items-start">
                <feather-icon :icon="ntf.icon" :svgClasses="[`text-${ntf.category}`, 'stroke-current mr-1 h-6 w-6']"></feather-icon>
                <div class="mx-2">
                  <span class="font-medium block notification-title" :class="[`text-${ntf.category}`]">{{ ntf.title }}</span>
                  <small>{{ ntf.msg }}</small>
                </div>
              </div>
              <small class="mt-1 whitespace-no-wrap">{{ elapsedTime(ntf.time) }}</small>
            </li>
            <li class="flex justify-around p-3 notification cursor-pointer">
              <small>View All Notifications</small>
            </li>
          </ul>
          </VuePerfectScrollbar>
        </vs-dropdown-menu>
      </vs-dropdown> -->

        <!-- SEARCHBAR -->
        <!-- <div class="search-full-container w-full h-full absolute pin-l rounded-lg" :class="{'flex': showFullSearch}" v-show="showFullSearch">
        <case-auto-suggest :autoFocus="showFullSearch" :data="navbarSearchAndPinList" @selected="selected" ref="navbarSearch" @closeSearchbar="showFullSearch = false" placeholder="Search..." class="w-full" inputClassses="w-full input-no-border no-icon-border" icon="SearchIcon" background-overlay></case-auto-suggest>
        <div class="absolute pin-r h-full z-50">
          <feather-icon icon="XIcon" class="px-4 cursor-pointer h-full close-search-icon" @click="showFullSearch = false"></feather-icon>
        </div>
      </div> -->
        <!-- <feather-icon icon="SearchIcon" @click="showFullSearch = true" class="cursor-pointer"></feather-icon> -->

        <!-- USER META -->
        <div class="the-navbar__user-meta flex items-center sm:ml-5 ml-2">
          <div class="text-right leading-tight hidden sm:block">
            <template v-if="isLogined">
              <p class="font-semibold text-left">
                {{ $store.getters["user/name"] }}
              </p>
              <small>{{ $store.getters["user/email"] }}</small>
            </template>
            <router-link to="/login" class="font-semibold" v-else>
              로그인 해주세요.
            </router-link>
          </div>
          <vs-dropdown v-if="isLogined" vs-custom-content vs-trigger-click>
            <div class="con-img ml-3">
              <img
                :src="
                  $store.getters['survey/profile'] ||
                    require('@/assets/images/profile/default.png')
                "
                alt="profile image"
                width="40"
                height="40"
                class="rounded-full shadow-md cursor-pointer block"
              />
            </div>
            <vs-dropdown-menu>
              <ul style="min-width: 9rem">
                <li
                  class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                  @click="$router.push('/profile')"
                >
                  <feather-icon
                    icon="UserIcon"
                    svgClasses="w-4 h-4"
                  ></feather-icon>
                  <span class="ml-2">프로필</span>
                </li>
                <li
                  class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                  @click="$router.push('/logout')"
                >
                  <feather-icon
                    icon="LogOutIcon"
                    svgClasses="w-4 h-4"
                  ></feather-icon>
                  <span class="ml-2">로그아웃</span>
                </li>
              </ul>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>
      </vs-navbar>
    </div>
  </div>
</template>

<script>

export default {
    name: 'case-header',
    props: {
        navbarColor: {
            type: String,
            default: '#fff',
        },
    },
    data() {
        return {
            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: 0.60,
            },
        };
    },
    computed: {
        activeUserInfo() {
            return this.$store.state.AppActiveUser;
        },
        sidebarWidth() {
            return this.$store.state.sidebarWidth;
        },
        breakpoint() {
            return this.$store.state.breakpoint;
        },
        classObj() {
            if (this.sidebarWidth === 'default') return 'navbar-default';
            if (this.sidebarWidth === 'reduced') return 'navbar-reduced';
            return 'navbar-full';
        },
        isLogined() {
            return this.$store.state.user.isLogined;
        },
    },
    methods: {
        showSidebar() {
            this.$store.commit('TOGGLE_IS_SIDEBAR_ACTIVE', true);
        },
        outside() {
            this.showBookmarkPagesDropdown = false;
        },
    },
};
</script>
