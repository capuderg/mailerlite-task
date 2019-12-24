export default {
    subscribers: state => {
        return state.subscribers
    },
    possibleStates: state => {
        return state.possibleStates
    },
    getAddSubscriberErrors: state => state.addSubscriberErrors,
    getEditSubscriberErrors: state => state.editSubscriberErrors
}
