import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  settings: null,
}

// getters
export const getters = {
  getSettings: state => state.settings,
  company_name: state => state.settings && state.settings[0].value  ? state.settings[0].value : 'ASP',
  light_logo: state => state.settings && state.settings[1].value ? state.settings[1].value : '',
  dark_logo: state =>state.settings && state.settings[2].value ? state.settings[2].value : '',
  favicon: state => state.settings && state.settings[3].value ? state.settings[3].value : 'favicon.png',
  sidebar_color: state => state.settings && state.settings[4].value ? state.settings[4].value : 'bg-white',
  topbar_color: state => state.settings && state.settings[5].value ? state.settings[5].value : 'bg-indigo-500',
  body_color: state => state.settings && state.settings[6].value ? state.settings[6].value : 'bg-gray-100',
  bradecamb_color: state => state.settings && state.settings[7].value ? state.settings[7].value : 'bg-gray-200',
  timezone: state => state.settings && state.settings[8].value ? state.settings[8].value : 'USA',
  contact_link: state => state.settings && state.settings[9].value ? state.settings[9].value : '/helpdesk',
}

// mutations
export const mutations = {
  [types.FETCH_SYSTEM_SETTING] (state, { settings }) {
    state.settings = settings
  },

}

// actions
export const actions = {

  async fetchSetting ({ commit }) {
    const { data } = await axios.get('/api/system-settings')
    commit(types.FETCH_SYSTEM_SETTING, { settings: data })
  }

}
