import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';

Vue.use(Vuex);

export default new Vuex.Store({

  state: {
    users: [],
    companies: [],
    employees: []
  },

  getters: {
    getAllUsers(state) {
      return state.users;
    },
    getAllCompanies(state) {
      return state.companies;
    },
    getAllEmployees(state) {
      return state.employees;
    }
  },

  actions: {
    getAllUsers(context) {
      Vue.axios.get('/auth/allusers')
        .then((response) => {
          context.commit('getAllUsers',response.data);
        })
    },

    getAllCompanies(context) {
      Vue.axios.get('/company')
        .then((response) => {
          context.commit('getAllCompanies',response.data);
        })
    },

    getAllEmployees(context) {
      Vue.axios.get('/employee')
        .then((response) => {
          context.commit('getAllEmployees',response.data);
        })
    }
  },

  mutations: {
    getAllUsers(state,payload) {
      state.users= payload;
    },

    getAllCompanies(state,payload) {
      state.companies= payload;
    },

    getAllEmployees(state,payload) {
      state.employees= payload;
    }
  },

  modules: {
    auth
  }

})
