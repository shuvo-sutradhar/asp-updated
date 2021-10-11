import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  loading:true,
  tags: null,
  serviceTags:null
}

// getters
export const getters = {
  loading: state => state.loading,
  tags: state => state.tags ? state.tags.data : '',
  pagination: state => state.tags ? state.tags.meta : {current_page:1},
  serviceTags: state => state.serviceTags
}

// mutations
export const mutations = {

  //get all team members
  [types.FETCH_TAGS] (state, { tags, loading }) {
    state.tags = tags
    state.loading = loading
  },

  //get all team members for assign in service
  [types.FETCH_SERVICE_TAGS] (state, { tags }) {
    state.serviceTags = tags
  },

  //get all team members
  [types.UPDATE_TAGS] (state,  {data} ) {
     Object.assign(state.tags.data.find(tag => tag.slug === data.slug), data);
  },

  // delete
  [types.DELETE_TAG] (state, { slug }) {
    state.tags.data = state.tags.data.filter(data => data.slug != slug)
  },

  // delete tags
  [types.DELETE_TAGS] (state, tagSlug) {
    state.tags.data = state.tags.data.filter(tag => !tagSlug.data.includes(tag.slug));
  },


}

// actions
export const actions = {

  // Fetch Team
  async fetchTag ({ commit } ,current_page) {
    const { data } = await axios.get(window.location.origin+'/api/tag?page='+current_page)
    commit(types.FETCH_TAGS, { tags: data, loading:false })
  },

  // Fetch Team
  async fetchServiceTags ({ commit }) {
    const { data } = await axios.get(window.location.origin+'/api/service-tags')
    commit(types.FETCH_SERVICE_TAGS, { tags: data });
  },

  // Fetch Search Data
  async fetchSearchData({ commit }, {query, current_page}) {
    const { data } = await axios.get(window.location.origin+'/api/tag-search/'+query+'?page='+current_page)
    commit(types.FETCH_TAGS, { tags: data })
  },


  // tagUpdate
  async tagUpdate({ commit }, payload) {
    commit(types.UPDATE_TAGS, payload)
  },


  // Delete user
  async deleteTag({ commit }, slug) {
    try {
      const {data} = await axios.delete(window.location.origin+'/api/tag/'+slug)
      commit(types.DELETE_TAG, { slug: slug })
      return data.success;
    } catch (error) {
      return error;
    }
  },


  // Delete multiple tags
  async deleteTags({ commit }, tagSlugs) {
    try {
      let {data} =await axios.post('/api/tag/delete_tags', { data: tagSlugs })
      commit(types.DELETE_TAGS, { data: tagSlugs })
      return data.success;
    } catch (error) {
      return error;
    }
  },


}
