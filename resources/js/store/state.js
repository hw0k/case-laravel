import colors from '@/../themeConfig';

const state = {
    isSidebarActive: true,
    breakpoint: null,
    sidebarWidth: 'default',
    reduceButton: colors.sidebarCollapsed,
    bodyOverlay: false,
    sidebarItemsMin: false,
    theme: colors.theme || 'light',
    AppActiveUser: {
        id: 0,
        name: 'John Doe',
        about: 'Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.',
        img: 'avatar-s-11.png',
        status: 'online',
    },

    themePrimaryColor: colors.primary,
};

export default state;
