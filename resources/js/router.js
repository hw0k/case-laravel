import Vue from 'vue';
import Router from 'vue-router';

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
            component: () => import('./layouts/Main.vue'),
            children: [
                {
                    path: '/profile',
                    component: () => import('./views/Profile.vue'),
                },
                {
                    path: '/shop',
                    component: () => import('./views/creditShop/CreditShop.vue'),
                    meta: {
                        pageTitle: '크레딧 상점',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '크레딧 상점 목록',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey',
                    component: () => import('./views/survey/list/SurveyList.vue'),
                    meta: {
                        pageTitle: '설문조사 목록',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사 목록',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create',
                    component: () => import('./views/survey/MakeSurvey.vue'),
                    meta: {
                        pageTitle: '일반 설문 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/view',
                    component: () => import('./views/survey/view/SurveyView.vue'),
                    meta: {
                        pageTitle: '설문조사 상세보기',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 상세보기',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create/tournament',
                    component: () => import('./views/survey/tournament.vue'),
                    meta: {
                        pageTitle: '토너먼트 설문조사 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                url: '/survey/create',
                            },
                            {
                                title: '토너먼트 설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create/selection',
                    component: () => import('./views/survey/selection.vue'),
                    meta: {
                        pageTitle: '선택형 설문조사 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                url: '/survey/create',
                            },
                            {
                                title: '선택형 설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create/short',
                    component: () => import('./views/survey/ShortAnswer.vue'),
                    meta: {
                        pageTitle: '단답형 설문조사 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                url: '/survey/create',
                            },
                            {
                                title: '단답형 설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create/long',
                    component: () => import('./views/survey/LongAnswer.vue'),
                    meta: {
                        pageTitle: '장문형 설문조사 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                url: '/survey/create',
                            },
                            {
                                title: '장문형 설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/create/OX',
                    component: () => import('./views/survey/OXQuiz.vue'),
                    meta: {
                        pageTitle: 'OX 설문조사 추가',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '설문조사',
                                url: '/survey',
                            },
                            {
                                title: '설문조사 추가',
                                url: '/survey/create',
                            },
                            {
                                title: 'OX 설문조사 추가',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/selectionStatistics',
                    component: () => import('./views/statistics/selectionStatistics.vue'),
                    meta: {
                        pageTitle: '선택형 설문조사 통계',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '통계',
                                url: '/statistics',
                            },
                            {
                                title: '선택형 설문조사 통계',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/OXStatistics',
                    component: () => import('./views/statistics/OXStatistics.vue'),
                    meta: {
                        pageTitle: 'OX 설문조사 통계',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '통계',
                                url: '/statistics',
                            },
                            {
                                title: 'OX 설문조사 통계',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/shortAnswerStatistics',
                    component: () => import('./views/statistics/shortAnswerStatistics.vue'),
                    meta: {
                        pageTitle: '단답형 설문조사 통계',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '통계',
                                url: '/statistics',
                            },
                            {
                                title: '단답형 설문조사 통계',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/longAnswerStatistics',
                    component: () => import('./views/statistics/longAnswerStatistics.vue'),
                    meta: {
                        pageTitle: '장문형 설문조사 통계',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '통계',
                                url: '/statistics',
                            },
                            {
                                title: '장문형 설문조사 통계',
                                active: true,
                            },
                        ],
                    },
                },
                {
                    path: '/survey/statistics/tournamentStatistics',
                    component: () => import('./views/statistics/tournamentStatistics.vue'),
                    meta: {
                        pageTitle: '토너먼트 통계',
                        breadcrumb: [
                            {
                                title: '홈',
                                url: '/',
                            },
                            {
                                title: '통계',
                                url: '/statistics',
                            },
                            {
                                title: '토너먼트 통계',
                                active: true,
                            },
                        ],
                    },
                },
            ],
        },
        {
            path: '',
            component: () => import('./layouts/Fullpage.vue'),
            children: [
                {
                    path: '/fullpage',
                    component: () => import('./views/Home.vue'),
                },
                {
                    path: '/login',
                    component: () => import('./views/Login.vue'),
                },
                {
                    path: '/register',
                    component: () => import('./views/Register.vue'),
                },
                {
                    path: '/resetpassword',
                    component: () => import('./views/ResetPassword.vue'),
                },
                {
                    path: '/forgetpassword',
                    component: () => import('./views/ForgotPassword.vue'),
                },
                {
                    path: '/404',
                    component: () => import('./views/404.vue'),
                },
                {
                    path: '/500',
                    component: () => import('./views/500.vue'),
                },
                {
                    path: '*',
                    component: () => import('./views/404.vue'),
                },
            ],
        },
    ],
});
