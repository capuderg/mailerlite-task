import Vue from 'vue'

export default {
    ADD_SUBSCRIBER({commit}, subscriber) {
        axios.post('/api/subscribers', subscriber).then(res => {
            Vue.$toast.success('Subscriber successfully added!')
            commit('ADD_SUBSCRIBER', res.data)
        }).catch((error) => {
            Vue.$toast.error(error.response.data.message)
            commit('UPDATE_ADD_SUBSCRIBER_ERRORS', error.response.data.errors)
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
            Vue.$toast.success('Subscriber successfully updated!')
            commit('UPDATE_SUBSCRIBER', res.data)
        }).catch(error => {
            Vue.$toast.error(error.response.data.message)
            commit('UPDATE_EDIT_SUBSCRIBER_ERRORS', error.response.data.errors)
        })
    }
}
