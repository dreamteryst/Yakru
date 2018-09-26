const state = {
    isAuth: localStorage.getItem('isAuth') === 'true',
};

const mutations = {
    login(state) {
        state.isAuth = true;
        localStorage.setItem('isAuth', true);
    },
    logout(state) {
        state.isAuth = false;
        localStorage.setItem('isAuth', false);
    },
};

export default {
    namespaced: true,
    state,
    mutations
}