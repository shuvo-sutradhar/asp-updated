import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    open: [],
}

// getters
export const getters = {
    active: (state) => (state.open.length > 0 ? state.open[0] : null),
    allOpen: (state) => state.open,
}

// mutations
export const mutations = {

    OPEN_DRAWER: (state, payload) => state.open.unshift(payload),
    CLOSE_DRAWER: (state, payload) => (state.open = state.open.filter((e) => e !== payload)),

}

// actions
export const actions = {
    open: ({ commit }, payload) => commit('OPEN_DRAWER', payload),
    close: ({ commit }, payload) => commit('CLOSE_DRAWER', payload),
}
