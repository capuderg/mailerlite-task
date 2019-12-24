export default {
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
        state.addSubscriberErrors = state.defaultSubscriberFields
    },
    UPDATE_EDIT_SUBSCRIBER_ERRORS(state, errors) {
        state.editSubscriberErrors = errors
    },
    RESET_EDIT_SUBSCRIBER_ERRORS(state) {
        state.editSubscriberErrors = state.defaultSubscriberFields
    },
    ADD_FIELD(state, field) {
        state.subscribers.map(subscriber => {
            if (subscriber.id === field.subscriber_id ) {
                subscriber.fields.push(field)
            }

            return subscriber
        })
    },
}
