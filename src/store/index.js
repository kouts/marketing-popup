import Vue from 'vue';
import Vuex from 'vuex';
import { fetchPopups, fetchPopup } from '@/api/popup';
import { fetchListOfValues } from '@/api/listOfValue';

Vue.use(Vuex);

export const state = {
  popups: [],
  popup: {},
  listOfValues: {}
};

export const actions = {
  async fetchPopups({ commit, state }) {
    try {
      const res = await fetchPopups();
      if (res.popups) {
        commit('SET_POPUPS', res.popups);
      }
    } catch (error) {
      console.log(error);
    }
  },
  async fetchPopup({ commit }, id) {
    try {
      const res = await fetchPopup(id);
      if (res.popup) {
        commit('SET_POPUP', res.popup);
      }
    } catch (error) {
      console.log(error);
    }
  },
  async fetchListOfValues({ commit, state }, names) {
    try {
      const res = await fetchListOfValues(names);
      if (res.listOfValues) {
        commit('SET_LIST_OF_VALUES', res.listOfValues);
      }
    } catch (error) {
      console.log(error);
    }
  }
};

export const mutations = {
  SET_POPUPS: (state, popups) => {
    state.popups = popups;
  },
  SET_POPUP: (state, popup) => {
    state.popup = popup;
  },
  SET_LIST_OF_VALUES: (state, listOfValues) => {
    state.listOfValues = listOfValues;
  }
};

export default new Vuex.Store({
  state,
  actions,
  mutations
});
