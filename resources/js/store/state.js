export default {
    subscribers: [],
    defaultSubscriberFields: {
        email: '',
        name: '',
        state: '',
    },
    addSubscriberErrors: {
        email: '',
        name: '',
        state: '',
    },
    editSubscriberErrors: {
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
}
