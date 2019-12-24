<template>
    <div class="subscriber-list table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="subscriber in subscribers">
                    <tr class="subscriber-row">
                        <td>{{ subscriber.id }}</td>
                        <td>{{ subscriber.email }}</td>
                        <td>{{ subscriber.name }}</td>
                        <td>{{ subscriber.state }}</td>
                        <td>
                            <a href="#" @click.prevent="deleteSubscriber(subscriber)" class="mr-3">&#10006;</a>
                            <a href="#" data-toggle="modal" data-target="#editSubscriber" @click="editSubscriber(subscriber)">&#9998;</a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4" v-if="subscriber.fields && 0 < subscriber.fields.length">
                            <table class="table table-striped table-sm table-dark">
                                <thead>
                                    <tr>
                                        <th>Field ID</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="field in subscriber.fields">
                                        <tr>
                                            <td>{{ field.id }}</td>
                                            <td>{{ field.title }}</td>
                                            <td>{{ field.type }}</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </td>
                        <td v-else>No fields are defined for this subscriber.</td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="editSubscriber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Subscriber</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="createSubscriber">
                            <div class="form-group">
                                <label for="edited-email">Email address</label>
                                <input type="email" class="form-control" :class="{'is-invalid': getEditSubscriberErrors.email.length}" id="edited-email" v-model="editedEmail">
                                <div class="invalid-feedback" v-if="getEditSubscriberErrors.email.length">
                                    {{ getEditSubscriberErrors.email.join(', ') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edited-name">Name</label>
                                <input type="text" class="form-control" id="edited-name" v-model="editedName">
                            </div>
                            <div class="form-group">
                                <label for="edited-state">State</label>
                                <select class="form-control" id="edited-state" v-model="editedState">
                                    <option v-for="state in possibleStates">{{ state }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="submitEditedSubscriber">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";

    export default {
        name: "SubscribersList",
        data() {
            return {
                editedId: 0,
                editedEmail: '',
                editedName: '',
                editedState: '',
            }
        },
        computed: {
            ...mapGetters(['subscribers', 'possibleStates', 'getEditSubscriberErrors'])
        },
        methods: {
            deleteSubscriber: function (subscriber) {
                this.$store.dispatch('DELETE_SUBSCRIBER', subscriber)
            },
            editSubscriber: function (subscriber) {
                this.editedId = subscriber.id
                this.editedEmail = subscriber.email
                this.editedName = subscriber.name
                this.editedState = subscriber.state
            },
            submitEditedSubscriber: function () {
                this.$store.commit('RESET_EDIT_SUBSCRIBER_ERRORS')

                let data = {
                    id: this.editedId,
                    email: this.editedEmail,
                    name: this.editedName,
                    state: this.editedState,
                };

                this.$store.dispatch('UPDATE_SUBSCRIBER', data)
            }
        }
    };
</script>
