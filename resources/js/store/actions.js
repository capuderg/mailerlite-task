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
        }).catch(error => {
            Vue.$toast.error(error.response.data.message)
        })
    },
    DELETE_SUBSCRIBER({commit}, subscriber) {
        axios.delete(`/api/subscribers/${subscriber.id}`).then(res => {
            Vue.$toast.success('Subscriber successfully deleted!')
            commit('DELETE_SUBSCRIBER', subscriber)
        }).catch(error => {
            Vue.$toast.error(error.response.data.message)
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
    },
    ADD_FIELD({commit}, field) {
        axios.post(`/api/subscribers/${field.subscriber_id}/fields`, field).then(res => {
            Vue.$toast.success('Field successfully added!')
            commit('ADD_FIELD', res.data)
        }).catch((error) => {
            Vue.$toast.error(error.response.data.message)
        })
    },
    DELETE_FIELD({commit}, field) {
        axios.delete(`/api/fields/${field.id}`).then(res => {
            Vue.$toast.success('Field successfully deleted!')
            commit('DELETE_FIELD', field)
        }).catch(error => {
            Vue.$toast.error(error.response.data.message)
        })
    },
    UPDATE_FIELD({commit}, field) {
        axios.put(`/api/fields/${field.id}`, field).then(res => {
            Vue.$toast.success('Field successfully updated!')
            commit('UPDATE_FIELD', res.data)
        }).catch(error => {
            Vue.$toast.error(error.response.data.message)
        })
    },
}
