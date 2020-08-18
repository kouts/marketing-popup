import Vue from 'vue';
import Vuex from 'vuex';
import { fetchPopups, fetchPopup } from '@/api/popup';
import { fetchListOfValues } from '@/api/listOfValue';
import { clone } from '@/common/utils';

Vue.use(Vuex);

export const popup = {
  id: 0,
  title: '',
  timer_enable: 0,
  timer_value: '',
  scrolling_trigger_enable: 0,
  scrolling_trigger_value: '',
  exit_intent_enable: 0,
  frequency_value: '',
  content: ''
};

export const state = {
  popups: [],
  popup: clone(popup),
  listOfValues: {}
};

export const actions = {
  async fetchPopups({ commit, state }) {
    try {
      const res = await fetchPopups();
      if (res) {
        commit('SET_POPUPS', res);
      }
    } catch (error) {
      console.log(error);
    }
  },
  async fetchPopup({ commit }, id) {
    try {
      const res = await fetchPopup(id);
      if (res) {
        commit('SET_POPUP', res);
      }
    } catch (error) {
      console.log(error);
    }
  },
  async fetchListOfValues({ commit, state }, names) {
    try {
      const res = await fetchListOfValues(names);
      if (res) {
        commit('SET_LIST_OF_VALUES', res);
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
