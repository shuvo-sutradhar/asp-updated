import axios from 'axios'
import * as types from '../mutation-types'
import Form from 'vform'

// state
export const state = {
    services:null, 
    selected: [],
    selectAll:false,
    loading:true,
    currency:[
        {
            id: 1,
            symbol: '$',
            name: 'USD'
        }, {
            id: 2,
            symbol: '$',
            name: 'CAD'
        }, {
            id: 3,
            symbol: '€',
            name: 'EUR'
        }
    ],
    form: new Form({
        name: null,
        description: null,
        teams: [],
        tags: [],
        service_type:0,
        currency:{
            id: 1,
            symbol: '$',
            name: 'USD'
        },
        onetime_service:{
            price: null,
            quantity: 1
        },
        requiring_service:{
            price: null,
            requring_period: 1,
            requring_for: 'month', 
            is_trail: false,
            trail: {
                price: null,
                period: 1,
                for: 'month',
            },
            requiring_status: 0,
            request_quantity: 2,
        },
        pricing_type:0,
        video: null,
        images: [],
        can_review: false,
        can_comment: true,
        group_quantities:false,
        deadline: null,
        deadline_for: 'hours',
        status: true,
    }),
}

// getters
export const getters = {
    getCurrency: state => state.currency,
    services: state => state.services ? state.services.data : '',
    loading: state => state.loading,
    pagination: state => state.services ? state.services.meta : {current_page:1},
    getSelectedArray: state =>  state.selected,
}

// mutations
export const mutations = {
    [types.FETCH_SERVICES] (state, { services, loading }) {
        state.services = services
        state.loading = loading
    },

    [types.SELECTED_CHECKBOX] (state, value) {
        state.selectAll = value
    },

    [types.SELECTED_SERVICES] (state, services) {
        state.selected = services
    },

    [types.FORM_ERRORS] (state, value) {
        state.form.errors.set(value);
    },

    [types.INPUT_SERVICE_NAME] (state, value) {
        state.form.name = value
    },

    [types.INPUT_SERVICE_DESC] (state, value) {
        state.form.description = value
    },

    [types.INPUT_SERVICE_TEAMS] (state, value) {
        state.form.teams = value
    },

    [types.INPUT_SERVICE_TAGS] (state, value) {
        state.form.tags = value
    }, 

    [types.ADD_SERVICE_TAGS] (state, value) {
        state.form.tags.push(value);
    },

    [types.INPUT_SERVICE_TYPE] (state, value) {
        state.form.service_type = value
    }, 

    [types.INPUT_ONE_TIME_SERVICE_PRICE] (state, value) {
        state.form.onetime_service.price = value
    },

    [types.INPUT_ONE_TIME_SERVICE_QTY] (state, value) {
        state.form.onetime_service.quantity = value
    },

    [types.INPUT_CURRENCY] (state, value) {
        state.form.currency = value
    },

    [types.REQUIRING_SERVICE_PRICE] (state, value) {
        state.form.requiring_service.price = value
    },

    [types.REQUIRING_SERVICE_PERIOD] (state, value) {
        state.form.requiring_service.requring_period = value
    },

    [types.REQUIRING_SERVICE_PERIOD_FOR] (state, value) {
        state.form.requiring_service.requring_for = value
    },

    [types.REQUIRING_SERVICE_IS_TRAIL] (state, value) {
        state.form.requiring_service.is_trail = value
    },

    [types.SERVICE_TRAIL_PRICE] (state, value) {
        state.form.requiring_service.trail.price = value
    },

    [types.SERVICE_TRAIL_PERIOD] (state, value) {
        state.form.requiring_service.trail.period = value
    },
    
    [types.SERVICE_TRAIL_FOR] (state, value) {
        state.form.requiring_service.trail.for = value
    },
    
    [types.REQUIRING_SERVICE_STATUS] (state, value) {
        state.form.requiring_service.requiring_status = value
    },
    
    [types.REQUIRING_REQUEST_QUANTITY] (state, value) {
        state.form.requiring_service.request_quantity = value
    },
    
    [types.SERVICE_VIDEO] (state, value) {
        state.form.video = value
    },
    
    [types.CAN_REVIEW] (state, value) {
        state.form.can_review = value
    },
    
    [types.CAN_COMMENT] (state, value) {
        state.form.can_comment = value
    },
    
    [types.GROUP_QUANTITIES] (state, value) {
        state.form.group_quantities = value
    },
    
    [types.SERVICE_DEADLINE] (state, value) {
        state.form.deadline = value
    },
    
    [types.SERVICE_DEADLINE_FOR] (state, value) {
        state.form.deadline_for = value
    },
    
    [types.SERVICE_STATUS] (state, value) {
        state.form.status = value
    },

    [types.DELETE_SERVICE] (state, { slug }) {
        state.services.data = state.services.data.filter(data => data.slug != slug)
    },

    [types.DELETE_SERVICES] (state, serviceSlug) {
        state.services.data = state.services.data.filter(service => !serviceSlug.data.includes(service.slug));
    },

}

// actions
export const actions = {
    /*
    * get service
    * @return string
    */
    async fetchService({ commit }, current_page) {
        const { data } = await axios.get(window.location.origin+'/api/service?page='+current_page)
        commit(types.FETCH_SERVICES, { services: data, loading:false })
    },

    /*
    * selected checkbox service
    * @return string
    */
    selectedCkbox({ commit }, data) {
        commit(types.SELECTED_CHECKBOX, data)
    },

    /*
    * selected Service
    * @return string
    */
    setSelectedArray({ commit }, data) {
        commit(types.SELECTED_SERVICES, data)
    },

    /*
    * search service
    * @return string
    */
    async fetchSearchData({ commit }, {query, current_page}) {
        const { data } = await axios.get(window.location.origin+'/api/service-search/'+query+'?page='+current_page)
        commit(types.FETCH_SERVICES, { services: data })
    },

    /*
    * Service name
    * @return string
    */
    async serviceSubmit({ commit ,state }) {
        await state.form.post(window.location.origin+'/api/service')
        .then((response)=>{
           state.form.reset();
        }).catch(()=>{
           // console.log("Error");
        });

    },

    /*
    * Service name
    * @return string
    */
    serviceFormError ({ commit }, value) {
       commit(types.FORM_ERRORS, value)
    },

    /*
    * Service name
    * @return string
    */
    serviceName ({ commit }, value) {
       commit(types.INPUT_SERVICE_NAME, value)
    },

    /*
    * Service description
    * @return string(text)
    */
    serviceDesc ({ commit }, value) {
       commit(types.INPUT_SERVICE_DESC, value)
    },

    /*
    * Service team member
    * @return array of object
    */
    serviceTeams ({ commit }, value) {
       commit(types.INPUT_SERVICE_TEAMS, value)
    },

    /*
    * Service tags
    * @return array
    */
    serviceTags ({ commit }, value) {
       commit(types.INPUT_SERVICE_TAGS, value)
    },

    /*
    * add new tag if not found in collection
    * @return object
    */
    addServiceTag({commit}, value) {
        commit(types.ADD_SERVICE_TAGS, value)
    },

    /*
    * One time service price
    * @return double
    */
    serviceType({commit}, value) {
        commit(types.INPUT_SERVICE_TYPE, value)
    }, 

    /*
    * One time service price
    * @return double
    */
    oneTimeServicePrice({commit}, value) {
        commit(types.INPUT_ONE_TIME_SERVICE_PRICE, value)
    },

    /*
    * Simple servie quantity
    * @return number
    */
    oneTimeServiceQty({commit}, value) {
        commit(types.INPUT_ONE_TIME_SERVICE_QTY, value)
    },

    /*
    * Service Currency
    * @return object
    */
    serviceCurrency({commit}, value) {
        commit(types.INPUT_CURRENCY, value)
    },

    /*
    * Subscription price
    * @return double
    */
    requiringServicePrice({commit}, value) {
        commit(types.REQUIRING_SERVICE_PRICE, value)
    },

    /*
    * Subscription period (1, 2, 3....)
    * @return number
    */
    requiringServicePeriod({commit}, value) {
        commit(types.REQUIRING_SERVICE_PERIOD, value)
    },

    /*
    * Subscription period for (Day, Month , Year)
    * @return string
    */
    requiringServicePeriodFor({commit}, value) {
        commit(types.REQUIRING_SERVICE_PERIOD_FOR, value)
    },

    /*
    * Service is Trail or not
    * @return boolean
    */
    requiringServiceIsTrail({commit}, value) {
        commit(types.REQUIRING_SERVICE_IS_TRAIL, value)
    },

    /*
    * Service Trail price
    * @return double number
    */
    serrviceTrailPrice({commit}, value) {
        commit(types.SERVICE_TRAIL_PRICE, value)
    },

    /*
    * Service Trail period (1,2,3,5....)
    * @return number
    */
    serrviceTrailPeriod({commit}, value) {
        commit(types.SERVICE_TRAIL_PERIOD, value)
    },

    /*
    * Service Trail for (Day, Month , Year)
    * @return string
    */ 
    serrviceTrailFor({commit}, value) {
        commit(types.SERVICE_TRAIL_FOR, value)
    },

    /*
    * Working on same order or not (For requiring service)
    * @return string
    */ 
    requiringServiceStatus({commit}, value) {
        commit(types.REQUIRING_SERVICE_STATUS, value)
    },

    /*
    * Requiring request quantity
    * @return string
    */ 
    requiringRequestQty({commit}, value) {
        commit(types.REQUIRING_REQUEST_QUANTITY, value)
    },

    /*
    * Service video
    * @return file
    */ 
    serviceVideo({commit}, value) {
        var formData = new FormData();
        formData.append("file", 'value');
        commit(types.SERVICE_VIDEO, formData)
    },

    /*
    * Client can review on this service or not.
    * @return boolean
    */ 
    canReview({commit}, value) {
        commit(types.CAN_REVIEW, value)
    },

    /*
    * Client can review on this service or not.
    * @return boolean
    */ 
    canComment({commit}, value) {
        commit(types.CAN_COMMENT, value)
    },

    /*
    * By default purchases of multiple quantities are added as separate orders. 
    * Different services are always added separately.
    * @return boolean
    */ 
    groupQuantities({commit}, value) {
        commit(types.GROUP_QUANTITIES, value)
    },

    /*
    * It's for team to see orders that are due soon, not visible to clients.
    * @return number
    */ 
    serviceDeadline({commit}, value) {
        commit(types.SERVICE_DEADLINE, value)
    },

    /*
    * deadline for (hours, days)
    * @return string
    */ 
    serviceDeadlineFor({commit}, value) {
        commit(types.SERVICE_DEADLINE_FOR, value)
    },

    /*
    * Service status
    * @return boolean
    */ 
    serviceStatus({commit}, value) {
        commit(types.SERVICE_STATUS, value)
    },

    /*
    * delete selected services 
    * @return string (slug)
    */ 
    async deleteService({ commit }, slug) {
        try {
            const {data} = await axios.delete(window.location.origin+'/api/service/'+slug)
            commit(types.DELETE_SERVICE, { slug: slug })
            return data.success;
        } catch (error) {
            return error;
        }
    },

    /*
    * delete all services 
    * @return string (slug)
    */ 
    async deleteServices({ commit }) {
        try {
            let {data} = await axios.post(window.location.origin+'/api/service/delete-services', { data: state.selected })
            commit(types.DELETE_SERVICES, { data: state.selected })
            return data.success;
        } catch (error) {
            return error;
        }
    }
}
