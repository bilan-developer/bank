import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const currency =  {
    state: {
        name: 'EUR',
    },
};

const loading =  {
    state: {
        spinner: false,
    },
    mutations: {
        setSpinner (state, spinner) {
            state.spinner = spinner
        }
    }
};

const auth =  {
    state: {
        user: null,
    },
    mutations: {
        setUser (state, user) {
            state.user = user
        }
    }
};

const url =  {
    state: {
        params: window.location.search,
    },
    mutations: {
        setParams (state, params) {
            state.params = params
        }
    }
};
// create a Vuex store instance
export default new Vuex.Store({
    modules: {
        currency  : currency,
        auth  : auth,
        loading  : loading,
        url  : url,
    }
});
