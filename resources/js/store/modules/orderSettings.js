import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  settings: null,
}

// getters
export const getters = {
  getSettings:          state => state.settings,
  initialOrderStatus:   state => state.settings && state.settings[0].value  ? state.settings[0].value : 'submitted',
  revision:             state => state.settings && state.settings[1].value ? state.settings[1].value : 'true',
  revisionOrderStatus:  state => state.settings && state.settings[2].value ? state.settings[2].value : 'working',
}

// mutations
export const mutations = {
  [types.FETCH_ORDER_SETTING] (state, { settings }) {
    state.settings = settings
  },

}

// actions
export const actions = {

  async fetchOrderSetting({ commit }) {
    const { data } = await axios.get('/api/order-settings')
    commit(types.FETCH_ORDER_SETTING, { settings: data })
  }

}
