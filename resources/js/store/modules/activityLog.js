import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  loading:true,
  roles: null, 
}

// getters
export const getters = {
  loading: state => state.loading,
  roles: state => state.roles ? state.roles.data : '',
}

// mutations
export const mutations = {
  [types.FETCH_ROLES] (state, { roles, loading }) {
    state.roles = roles
    state.loading = loading
  }, 

}

// actions
export const actions = {

  // Fetch Roles
  async fetchRoles ({ commit }) {
    const { data } = await axios.get(window.location.origin+'/api/role')
    commit(types.FETCH_ROLES, { roles: data, loading:false })
  },


}
