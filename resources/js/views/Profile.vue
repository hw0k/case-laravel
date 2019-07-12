<template>
    <div id="profile-page">

        <!-- PROFILE HEADER -->
        <div class="profile-header">
            <div class="relative">
                <div class="block w-full bottom-0 bg-dark-gradient absolute h-32">
                    <div class="text-lg text-white mt-5 text-center">{{user.u_name}}</div>
                    <div class="text-lg text-white text-center">{{user.u_account}}</div>
                    <div class="text-lg text-white text-center">{{user.u_email}}</div>
                </div>
                <div class="cover-container rounded-t-lg">
                    <img :src="require(`@/assets/images/profile/user-uploads/${userCoverImg}`)" alt="user-profile-cover" class="responsive block">
                </div>
                <div class="profile-img-container pointer-events-none">
                    <div>
                        <vs-avatar class="user-profile-img" :src="require('@/assets/images/profile/default.png')" size="200px" />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end flex-wrap profile-header-nav p-6">
                <div class="w-full flex-grow sm:flex sm:items-center sm:w-auto ">
                    <div class="text-sm sm:flex-grow">
                        <ul class="sm:flex justify-around mt-8 w-full md:mt-0 md:ml-auto ">
                            <li class="p-2 sm:p-0 text-lg text-primary">크레딧관리</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- COL AREA -->
        <div class="vx-row">
          <!-- COL 1 -->
          <div class="vx-col w-full lg:w-1/3 mt-2">
            <case-card title="보유현황" class="mt-base p-4 text-left">
              <hr>
              <div class="text-lg text-warning m-8 float-right">{{user.u_point}}p</div>
              <div class="text-lg text-gray-800 m-8">나의 크레딧</div>
              <div class="mt-5">
                  <vs-button class="ml-8 mb-4" type="border" color="#CE9FFC">충전하기</vs-button>
              </div>
            </case-card>
          </div>

            <!-- COL 2 -->
            <div class="vx-col w-full lg:w-2/3 mt-2">
                <case-card class="mt-base p-4 text-left" title="사용내역">

                    <div>
                       <hr>
                      <div class="">
                        <div class="text-base text-gray-600 m-8 float-left">25일 토</div>
                        <div class="text-xl text-warning mt-8 mr-8 float-right">+ 1,000 p</div>
                        <div class="vx-col m-8">
                          <div class="text-lg text-gray-800">abc</div>
                          <div class="text-xl font-bold mt-5">대소고 설문조사 응시</div>
                        </div>
                      </div>
                    </div>

                    <div>
                       <hr>
                      <div class="">
                        <div class="text-base text-gray-600 m-8 float-left">26일 일</div>
                        <div class="text-xl text-warning mt-8 mr-8 float-right">- 20,000 p</div>
                        <div class="vx-col m-8">
                          <div class="text-lg text-gray-800">카카오프렌즈</div>
                          <div class="text-xl font-bold mt-5">러블리어피치 얼굴쿠션</div>
                        </div>
                      </div>
                    </div>

                    <div>
                       <hr>
                      <div class="">
                        <div class="text-base text-gray-600 m-8 float-left">26일 일</div>
                        <div class="text-xl text-warning mt-8 mr-8 float-right">- 5,000 p</div>
                        <div class="vx-col m-8">
                          <div class="text-lg text-gray-800">이디야</div>
                          <div class="text-xl font-bold mt-5">아메리카노</div>
                        </div>
                      </div>
                    </div>
                </case-card>
            </div>

        </div>
        <vs-popup classContent="popup-example" title="Lorem ipsum dolor sit amet" :active.sync="popupActive2">
          <vs-input class="inputx mb-3" placeholder="Placeholder" v-model="value1" />
          <vs-input disabled class="inputx mb-3" placeholder="Disabled" v-model="value2" />
        </vs-popup>
    </div>
</template>

<script>

export default {
    data() {
        return {
            isNavOpen: false,
            userPoll: '',
            userInfo: {
                profileImg: 'user-13.jpg',
            },
            user: {},
            userCoverImg: 'cover.jpg',
            wasSidebarOpen: null,
            value1: '',
            value2: '',
            popupActive2: false,
            popupActive3: false,
        };
    },
    created() {
        this.$http.get(`/user/${this.$store.getters['user/idx']}`)
            .then((response) => {
                this.user = response.data;
            })
            .catch((err) => {
                console.log(err);
            });
    },
    computed: {
    },
};
</script>

<style lang="scss">
@import "@/assets/scss/vuesax/pages/profile.scss";
</style>
