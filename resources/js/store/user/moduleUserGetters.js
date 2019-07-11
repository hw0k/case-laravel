
export default {
    name: state => state.userInfo.u_name,
    email: state => state.userInfo.u_email,
    profile: state => window.baseURL + state.userInfo.u_profile,
};
