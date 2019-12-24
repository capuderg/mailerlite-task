<template>
    <div class="add-subscriber mb-3">
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Add a Subscriber</h5>
                <form @submit.prevent="createSubscriber">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" :class="{'is-invalid': getAddSubscriberErrors.email.length}" id="email" v-model="email">
                        <div class="invalid-feedback" v-if="getAddSubscriberErrors.email.length">
                            {{ getAddSubscriberErrors.email.join(', ') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" v-model="state">
                            <option v-for="state in possibleStates">{{ state }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        name: "AddSubscriber",
        data() {
            return {
                email: '',
                name: '',
                state: 'unconfirmed'
            }
        },
        computed: {
            ...mapGetters(['possibleStates', 'getAddSubscriberErrors'])
        },
        methods: {
            createSubscriber: function () {
                this.$store.commit('RESET_ADD_SUBSCRIBER_ERRORS')

                let data = {
                    email: this.email,
                    name: this.name,
                    state: this.state
                }

                this.$store.dispatch('ADD_SUBSCRIBER', data)
            }
        }
    };
</script>
