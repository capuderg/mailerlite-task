import Vue from 'vue'
import Vuex from 'vuex'
import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/index.css'

Vue.use(Vuex)
Vue.use(VueToast, {
    position: 'top',
    duration: 6000
})

export default new Vuex.Store({
    state: {
        subscribers: [],
        addSubscriberErrors: {
            email: '',
            name: '',
            state: '',
        },
        possibleStates: [
            'active',
            'unsubscribed',
            'junk',
            'bounced',
            'unconfirmed',
        ]
    },
    getters: {
        subscribers: state => {
            return state.subscribers
        },
        possibleStates: state => {
            return state.possibleStates
        },
        getAddSubscriberErrors: state => state.addSubscriberErrors
    },
    mutations: {
        ADD_SUBSCRIBER(state, subscriber) {
            state.subscribers.push(subscriber)
        },
        SET_SUBSCRIBERS(state, subscribers) {
            state.subscribers = subscribers
        },
        DELETE_SUBSCRIBER(state, subscriber) {
            state.subscribers.splice(state.subscribers.indexOf(subscriber), 1)
        },
        UPDATE_SUBSCRIBER(state, subscriber) {
            state.subscribers.map(existingSubscriber => {
                if (existingSubscriber.id === subscriber.id) {
                    return Object.assign(existingSubscriber, subscriber)
                }

                return existingSubscriber
            });
        },
        UPDATE_ADD_SUBSCRIBER_ERRORS(state, errors) {
            state.addSubscriberErrors = errors
        },
        RESET_ADD_SUBSCRIBER_ERRORS(state) {
            state.addSubscriberErrors = {
                email: '',
                name: '',
                state: '',
            }
        }
    },
    actions: {
        ADD_SUBSCRIBER({commit}, subscriber) {
            axios.post('/api/subscribers', subscriber).then(res => {
                commit('ADD_SUBSCRIBER', res.data)
            }).catch((error) => {
                console.log(error.response.data)
                commit('UPDATE_ADD_SUBSCRIBER_ERRORS', error.response.data.errors)
                Vue.$toast.error(error.response.data.message)
            })
        },
        GET_SUBSCRIBERS({commit}) {
            axios.get('/api/subscribers').then(res => {
                commit('SET_SUBSCRIBERS', res.data)
            }).catch(err => {
                console.log(err)
            })
        },
        DELETE_SUBSCRIBER({commit}, subscriber) {
            axios.delete(`/api/subscribers/${subscriber.id}`).then(res => {
                commit('DELETE_SUBSCRIBER', subscriber)
            }).catch(err => {
                console.log(err)
            })
        },
        UPDATE_SUBSCRIBER({commit}, subscriber) {
            axios.put(`/api/subscribers/${subscriber.id}`, subscriber).then(res => {
                commit('UPDATE_SUBSCRIBER', res.data)
            }).catch(err => {
                console.log(err)
            })
        }
    }
})
