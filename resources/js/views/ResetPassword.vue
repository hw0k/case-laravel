<template>
  <div class="h-screen flex w-full bg-img">
    <div class="vx-col sm:w-3/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row">
            <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
              <img src="@/assets/images/pages/reset-password.png" alt="login" class="mx-auto">
            </div>
            <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center  bg-white">
              <div class="p-8 text-left">
                  <div class="vx-card__title mb-8">
                    <h4 class="mb-4">비밀번호 초기화</h4>
                    <p>새 비밀번호를 입력하세요.</p>
                  </div>
                  <vs-input type="email" label-placeholder="이메일" v-model="value1" class="w-full mb-6" />
                  <vs-input type="password" label-placeholder="비밀번호" v-model="value2" class="w-full mb-6" />
                  <vs-input type="password" label-placeholder="비밀번호 확인" v-model="value3" class="w-full mb-8" />

                  <div class="flex flex-wrap justify-between flex-col-reverse sm:flex-row">
                    <vs-button type="flat" to="/login" class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto">로그인 화면으로 돌아가기</vs-button>
                    <vs-button class="w-full sm:w-auto">초기화</vs-button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            value1: '',
            value2: '',
            value3: '',
        };
    },
};
</script>
