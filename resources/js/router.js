import Vue from 'vue';
import Router from 'vue-router';
import Main from './layouts/Main.vue';
import Home from './views/Home.vue';
import Test from './views/Test.vue';
import Hello from './views/Hello.vue';
import Profile from './views/Profile.vue';
import SurveyList from './views/survey/list/SurveyList.vue';
import MakeSurvey from './views/survey/MakeSurvey.vue';
import tournament from './views/survey/tournament.vue';
import selection from './views/survey/selection.vue';
import ShortAnswer from './views/survey/ShortAnswer.vue';
import LongAnswer from './views/survey/LongAnswer.vue';
import OXQuiz from './views/survey/OXQuiz.vue';
import selectionStatistics from './views/statistics/selectionStatistics.vue';
import Fullpage from './layouts/Fullpage.vue';
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import ResetPassword from './views/ResetPassword.vue';
import ForgotPassword from './views/ForgotPassword.vue';
import Page404 from './views/404.vue';
import Page500 from './views/500.vue';

Vue.use(Router);
/**
 * dynamic import 삭제 쿼리
 * import\('.*\/(.*).vue'\) 검색
 * ctrl shift l
 * 복사
 * 위에 붙이고 replace
 */
// import\('(.*/(.*).vue)'\)
// import $2 from '$1';

/**
 * 라우터 추가하는 곳
 * path: 사용할 url
 * component: 사용할 컴포넌트 (import()를 사용하여 lazy load사용하는 것을 추천)
 * meta: {
 *  rule: 접근할 수 있는 권한 - 현재는 사용 안함
 *  pageTitle: 페이지 제목
 *  broadcrumb: 페이지의 경로 (배열)
 * }
 */
export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '',
            component: Main,
            children: [
                {
                    path: '/',
                    component: Home,
                },
                {
                    path: '/home',
                    component: Home,
                },
                {
                    path: '/test',
                    component: Test,
                },
                {
                    path: '/hello',
                    component: Hello,
                },
                {
                    path: '/profile',
                    component: Profile,
                },
                {
                    path: '/survey',
                    component: SurveyList,
                    meta: {
                        pageTitle: '설문조사 목록',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사 목록', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create',
                    component: MakeSurvey,
                    meta: {
                        pageTitle: '일반 설문 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create/tournament',
                    component: tournament,
                    meta: {
                        pageTitle: '토너먼트 설문조사 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', url: '/survey/create' },
                            { title: '토너먼트 설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create/selection',
                    component: selection,
                    meta: {
                        pageTitle: '선택형 설문조사 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', url: '/survey/create' },
                            { title: '선택형 설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create/short',
                    component: ShortAnswer,
                    meta: {
                        pageTitle: '단답형 설문조사 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', url: '/survey/create' },
                            { title: '단답형 설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create/long',
                    component: LongAnswer,
                    meta: {
                        pageTitle: '장문형 설문조사 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', url: '/survey/create' },
                            { title: '장문형 설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/create/OX',
                    component: OXQuiz,
                    meta: {
                        pageTitle: 'OX 설문조사 추가',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '설문조사', url: '/survey' },
                            { title: '설문조사 추가', url: '/survey/create' },
                            { title: 'OX 설문조사 추가', active: true },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/selectionStatistics',
                    component: selectionStatistics,
                    meta: {
                        pageTitle: '선택형 설문조사 통계',
                        breadcrumb: [
                            { title: '홈', url: '/' },
                            { title: '통계', url: '/statistics' },
                            { title: '선택형 설문조사 통계', active: true },
                        ],
                    },
                },
            ],
        },
        {
            path: '',
            component: Fullpage,
            children: [
                {
                    path: '/fullpage',
                    component: Home,
                },
                {
                    path: '/login',
                    component: Login,
                },
                {
                    path: '/register',
                    component: Register,
                },
                {
                    path: '/resetpassword',
                    component: ResetPassword,
                },
                {
                    path: '/forgetpassword',
                    component: ForgotPassword,
                },
                {
                    path: '/404',
                    component: Page404,
                },
                {
                    path: '/500',
                    component: Page500,
                },
                {
                    path: '*',
                    component: Page404,
                },
            ],
        },
    ],
});
