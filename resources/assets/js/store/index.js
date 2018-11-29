import Vue from "vue";
import Vuex from "vuex";
import auth from "./auth";

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== "production";
export default new Vuex.Store({
    modules: {
        auth
    },
    strict: debug,
    state: {
        user: {}
    },
    mutations: {
        setUser: (state, user) => (state.user = user)
    },
    actions: {
        initialize({ commit, dispatch }) {
            axios
                .get("/api/user")
                .then(({ data }) => {
                    if (!data) {
                        commit("auth/logout");
                    } else {
                        commit("setUser", data);
                        commit("auth/login");
                    }
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        commit("auth/logout");
                    }
                });
        },
        adminInitialize({ commit, dispatch }) {
            axios
                .get("/admin/user")
                .then(({ data }) => {
                    if (!data) {
                        commit("auth/logout");
                    } else {
                        commit("setUser", data);
                        commit("auth/login");
                    }
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        commit("auth/logout");
                    }
                });
        }
    }
});
