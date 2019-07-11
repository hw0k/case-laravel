import Vue from 'vue';
import Vuesax from 'vuesax';

const colors = {
    primary: '#7367F0',
    success: '#28C76F',
    danger: '#EA5455',
    warning: '#FF9F43',
    dark: '#1E1E1E',
};

Vue.use(Vuesax, { theme: { colors } });


// CONFIGS
const themeConfig = {
    theme: 'light',
    sidebarCollapsed: false,
    navbarColor: '#fff',
    navbarType: 'sticky',
    footerType: 'static',
    routerTransition: 'zoom-fade',
    disableCustomizer: false,
};

export default themeConfig;
