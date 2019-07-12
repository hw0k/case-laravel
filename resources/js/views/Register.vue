<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter">
            <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center text-center">
              <img src="@/assets/case_logo.png" alt="register" class="mx-auto lg:w-3/4 mb-2">
            </div>
            <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center bg-white">
              <div class="p-8">
                <div class="vx-card__title text-left">
                  <h4 class="mb-4">계정 생성</h4>
                  <p>계정 생성을 위해 아래 항목들을 채워주세요.</p>
                </div>
                <div class="clearfix text-left">
                  <vs-input
                      v-validate="'required'"
                      data-vv-validate-on="blur"
                      label-placeholder="이름"
                      name="username"
                      v-model="username"
                      class="w-full" />
                  <span class="text-danger text-sm w-full">{{ errors.first('username') }}</span>

                 <div class="w-full">
                    <vs-input
                      v-validate="'required|alpha_dash'"
                      data-vv-validate-on="blur"
                      label-placeholder="아이디"
                      name="account"
                      v-model="account"
                      class="w-3/5 pr-2 float-left" />
                    <vs-button type="border" class="mt-5 mb-1 w-2/5" @click="checkID">중복 체크</vs-button>
                 </div>
                  <span class="text-danger text-sm">{{ errors.first('account') }}</span>

                  <vs-input
                      v-validate="'required|email'"
                      data-vv-validate-on="blur"
                      name="email"
                      type="email"
                      label-placeholder="이메일"
                      v-model="email"
                      class="w-full mt-6" />
                  <span class="text-danger text-sm">{{ errors.first('email') }}</span>

                  <vs-input
                      ref="password"
                      type="password"
                      data-vv-validate-on="blur"
                      name="password"
                      label-placeholder="비밀번호"
                      v-model="password"
                      class="w-full mt-6" />
                  <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                  <vs-input
                      type="password"
                      v-validate="'confirmed:password'"
                      data-vv-validate-on="blur"
                      data-vv-as="password"
                      name="confirm_password"
                      label-placeholder="비밀번호 확인"
                      v-model="confirm_password"
                      class="w-full mt-6" />
                  <span class="text-danger text-sm">{{ errors.first('confirm_password') }}</span>

                  <vs-checkbox v-model="isTermsConditionAccepted" class="mt-6">CASE 약관 동의</vs-checkbox>
                  <vs-button  type="border" to="/login" class="mt-6">로그인</vs-button>
                  <vs-button class="float-right mt-6" @click="registerUser" :disabled="!validateForm">회원가입</vs-button>
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
            username: '',
            account: '',
            email: '',
            password: '',
            confirm_password: '',
            isTermsConditionAccepted: true,
            isCheck: false,
        };
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.isCheck === true && this.username !== '' && this.email !== '' && this.account !== '' && this.password !== '' && this.confirm_password !== '' && this.isTermsConditionAccepted === true;
        },
    },
    methods: {
        registerUser() {
            if (!this.validateForm) return false;
            this.$http.post('/user/register', {
                account: this.account,
                password: this.password,
                name: this.username,
                email: this.email,
            })
                .then(() => {
                    this.$vs.notify({
                        title: '회원가입',
                        text: '회원가입이 완료되었습니다.',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                    });
                    this.$router.push('/login');
                })
                .catch((e) => {
                    console.error(e);
                });
        },
        checkID() {
            if (this.account === '') {
                this.$vs.notify({
                    title: '아이디',
                    text: '아이디를 입력해주세요.',
                    color: 'danger',
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                });
            } else {
                this.$http.get(`/user/idCheck/${this.account}`)
                    .then(({ data }) => {
                        if (data.idx === 1) {
                            this.$vs.notify({
                                title: '아이디',
                                text: '다른 아이디를 입력해주세요.',
                                color: 'danger',
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                            });
                            this.isCheck = false;
                            this.account = '';
                        }
                    })
                    .catch((e) => {
                        console.error(e);
                        this.$vs.notify({
                            title: '아이디',
                            text: '사용 가능한 아이디입니다.',
                            color: 'success',
                            iconPack: 'feather',
                            icon: 'icon-check',
                        });
                        this.isCheck = true;
                    });
            }
        },
    },
};
</script>
