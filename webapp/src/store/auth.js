import axios from 'axios';

export default {
  namespaced: true,

  state: {
    token: null,
    user: null
  },

  getters: {
    authenticated(state) {
      return state.token && state.user;
    },
    user(state) {
      return state.user;
    }
  },

  mutations: {
    SET_TOKEN(state, access_token) {
      state.token= access_token
    },
    SET_USER(state, data) {
      state.user= data
    }
  },

  actions: {
    async signIn({ dispatch }, credentials) {
      let response= await axios.post('auth/login', credentials)
      return dispatch('attempt', response.data.access_token);
    },

    async attempt({ commit, state }, access_token) {
      commit('SET_TOKEN', access_token);
      if(access_token) {
        commit('SET_TOKEN', access_token);
      }
      if(!state.token) {
        return
      }
      try {
        let response= await axios.get('auth/me');
        commit('SET_USER', response.data);
      } catch(e) {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
      }
    },

    signOut({ commit }) {
      return axios.post('auth/logout').then(()=> {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
      })
    }

  }

}
