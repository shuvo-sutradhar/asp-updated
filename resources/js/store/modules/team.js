import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  loading:true,
  teams: null,
  serviceTeam:null,
}

// getters
export const getters = {
  loading: state => state.loading,
  teams: state => state.teams ? state.teams.data : '',
  pagination: state => state.teams ? state.teams.meta : {current_page:1},
  serviceTeam: state => state.serviceTeam
}

// mutations
export const mutations = {

  //get all team members
  [types.FETCH_TEAMS] (state, { teams, loading }) {
    state.teams = teams
    state.loading = loading
  },

  //get all team members for assign in service
  [types.FETCH_SERVICE_TEAMS] (state, { teams }) {
    state.serviceTeam = teams
  },

  // delete
  [types.DELETE_TEAM] (state, { slug }) {
    state.teams.data = state.teams.data.filter(data => data.slug != slug)
  },

  // delete teams
  [types.DELETE_TEAMS] (state, teamSlug) {
    state.teams.data = state.teams.data.filter(team => !teamSlug.data.includes(team.slug));
  },

}

// actions
export const actions = {

  // Fetch Team
  async fetchTeam ({ commit } ,current_page) {
    const { data } = await axios.get(window.location.origin+'/api/team?page='+current_page)
    commit(types.FETCH_TEAMS, { teams: data, loading:false })
  },

  // Fetch Team
  async fetchServiceTeam ({ commit }) {
    const { data } = await axios.get(window.location.origin+'/api/service-teams')
    commit(types.FETCH_SERVICE_TEAMS, { teams: data });
  },

  // Fetch Search Data
  async fetchSearchData({ commit }, {query, current_page}) {
    const { data } = await axios.get(window.location.origin+'/api/team-search/'+query+'?page='+current_page)
    commit(types.FETCH_TEAMS, { teams: data })
  },


  // Delete user
  async deleteTeam({ commit }, slug) {
    try {
      const {data} = await axios.delete(window.location.origin+'/api/team/'+slug)
      commit(types.DELETE_TEAM, { slug: slug })
      return data.success;
    } catch (error) {
      return error;
    }
  },


  // Delete multiple users
  async deleteTeams({ commit }, teamSlugs) {
    try {
      let {data} =await axios.post('/api/team/delete_teams', { data: teamSlugs })
      commit(types.DELETE_TEAMS, { data: teamSlugs })
      return data.success;
    } catch (error) {
      return error;
    }
  },


}
