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

    OPEN_MODAL: (state, payload) => state.open.unshift(payload),
    CLOSE_MODAL: (state, payload) => (state.open = state.open.filter((e) => e !== payload)),

}

// actions
export const actions = {
    open: ({ commit }, payload) => commit('OPEN_MODAL', payload),
    close: ({ commit }, payload) => commit('CLOSE_MODAL', payload),
}
