/**
 * 사이드바에 들어갈 아이템 리스트 설정
 *
 * 헤더 구조
 * header: 헤더 이름
 * --------------------
 * 아이템 구조
 * url: 라우터 경로 null이면 라우터로 이동안함 (children이 있을 때 null로)
 * name: 사이드바에 표시할 이름
 * slug: 라우터 이름
 * icon: 사이드바에 표시할 아이콘 src/components/FeatherIcon.vue 참고
 * tag: 뱃지에 표시할 내용
 * tagColor: 뱃지 컬러
 * submenu: 자식 아이템 리스트 (배열)
 * isDisabled: disable 여부
 */
export default [{
    url: null,
    name: '메인',
    slug: 'main',
    icon: 'HomeIcon',
    submenu: [{
        url: '/profile',
        name: '프로필',
    },
    {
        url: '/shop',
        name: '크레딧 상점',
    },
    {
        url: '/survey',
        name: '설문조사',
    },
    {
        url: '/survey/create',
        name: '설문조사 추가',
    },
    {
        url: '/survey/view',
        name: '설문조사 보기',
    },
    {
        url: null,
        name: '설문조사 종류',
        icon: 'PlusSquareIcon',
        submenu: [{
            url: '/survey/create/tournament',
            name: '토너먼트형 추가',
        },
        {
            url: '/survey/create/selection',
            name: '선택형 추가',
        },
        {
            url: '/survey/create/short',
            name: '단답형 추가',
        },
        {
            url: '/survey/create/long',
            name: '장문형 추가',
        },
        {
            url: '/survey/create/OX',
            name: 'OX형 추가',
        },
        ],
    },
    {
        url: null,
        name: '통계 페이지',
        icon: 'PlusSquareIcon',
        submenu: [{
            url: '/survey/statistics/selectionStatistics',
            name: '선택형 설문조사 통계',
        },
        {
            url: '/survey/statistics/OXStatistics',
            name: 'OX 설문조사 통계',
        },
        {
            url: '/survey/statistics/shortAnswerStatistics',
            name: '단답형 설문조사 통계',
        },
        {
            url: '/survey/statistics/longAnswerStatistics',
            name: '장문형 설문조사 통계',
        },
        {
            url: '/survey/statistics/tournamentStatistics',
            name: '토너먼트 통계',
        },
        ],
    },
    ],
},
{
    header: '풀페이지',
},
{
    url: null,
    name: '풀페이지',
    slug: 'fullpage',
    icon: 'HomeIcon',
    submenu: [{
        url: '/fullpage',
        name: '풀 페이지 테스트',
    },
    {
        url: '/login',
        name: '로그인',
    },
    {
        url: '/register',
        name: '회원가입',
    },
    {
        url: '/resetpassword',
        name: '패스워드 재설정',
    },
    {
        url: '/forgetpassword',
        name: '패스워드 찾기',
    },
    {
        url: '/404',
        name: '404 페이지',
    },
    {
        url: '/500',
        name: '500페이지',
    },
    ],
},
];
