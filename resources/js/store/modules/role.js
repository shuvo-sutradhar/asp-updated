import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  loading:true,
  roles: null, 
  permissions: null,
}

// getters
export const getters = {
  loading: state => state.loading,
  roles: state => state.roles ? state.roles.data : '',
  getPermissions: state => state.permissions,
}

// mutations
export const mutations = {
  [types.FETCH_ROLES] (state, { roles, loading }) {
    state.roles = roles
    state.loading = loading
  }, 

  [types.FETCH_PERMISSIONS] (state, { permissions }) {
    state.permissions = permissions
  },

  [types.DELETE_ROLE] (state, { roleSlug }) {
      state.roles.data = state.roles.data.filter(role => role.slug != roleSlug)
  },
}

// actions
export const actions = {

  // Fetch Roles
  async fetchRoles ({ commit }) {
    const { data } = await axios.get(window.location.origin+'/api/role')
    commit(types.FETCH_ROLES, { roles: data, loading:false })
  },


  // Fetch Permissions
  async fetchPermissions ({ commit }) {
    const { data } = await axios.get(window.location.origin+'/api/permission')
    commit(types.FETCH_PERMISSIONS, { permissions: data })
  },



  // Delete Roles
  async deleteRoles ({ commit }, slug) {

      try {
        const {data} = await axios.delete(window.location.origin+'/api/role/'+slug)
        commit(types.DELETE_ROLE, { roleSlug: slug })
        return data.success;
      } catch (error) {
        return error;
      }

  },

}
