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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="field in subscriber.fields">
                                        <tr>
                                            <td>{{ field.id }}</td>
                                            <td>{{ field.title }}</td>
                                            <td>{{ field.type }}</td>
                                            <td>
                                                <a href="#" @click.prevent="deleteField(field)" class="mr-3">&#10006;</a>
                                                <a href="#" data-toggle="modal" data-target="#editField" @click="editField(field)">&#9998;</a>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td colspan="4">
                                            <a href="#" data-toggle="modal" data-target="#addField" @click="createField(subscriber.id)">+ Add a field</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td v-else>
                            <p>No fields are defined for this subscriber.</p>
                            <p><a href="#" data-toggle="modal" data-target="#addField" @click="createField(subscriber.id)">+ Add a field</a></p>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Subscriber Modal -->
        <div class="modal fade" id="editSubscriber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Subscriber</h5>
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

        <!-- Add Field Modal -->
        <div class="modal fade" id="addField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Field</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="edited-email">Title</label>
                                <input type="email" class="form-control" id="title" v-model="title" required>
                            </div>
                            <div class="form-group">
                                <label for="edited-state">Type</label>
                                <select class="form-control" id="type" v-model="type">
                                    <option v-for="type in possibleTypes">{{ type }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="submitCreateField">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Field Modal -->
        <div class="modal fade" id="editField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Field</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="edited-email">Title</label>
                                <input type="email" class="form-control" id="edited-title" v-model="editedTitle" required>
                            </div>
                            <div class="form-group">
                                <label for="edited-state">Type</label>
                                <select class="form-control" id="edited-type" v-model="editedType">
                                    <option v-for="type in possibleTypes">{{ type }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="submitEditedField">Save changes</button>
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
                fieldSubscriberId: 0,
                title: '',
                type: 'string',
                editedFieldId: 0,
                editedTitle: '',
                editedType: '',
            }
        },
        computed: {
            ...mapGetters(['subscribers', 'possibleStates', 'getEditSubscriberErrors', 'possibleTypes'])
        },
        methods: {
            deleteSubscriber: function (subscriber) {
                this.$store.dispatch('DELETE_SUBSCRIBER', subscriber)
            },
            deleteField: function (field) {
                this.$store.dispatch('DELETE_FIELD', field)
            },
            editSubscriber: function (subscriber) {
                this.editedId = subscriber.id
                this.editedEmail = subscriber.email
                this.editedName = subscriber.name
                this.editedState = subscriber.state
            },
            submitEditedSubscriber: function () {
                this.$store.commit('RESET_EDIT_SUBSCRIBER_ERRORS')

                const data = {
                    id: this.editedId,
                    email: this.editedEmail,
                    name: this.editedName,
                    state: this.editedState,
                };

                this.$store.dispatch('UPDATE_SUBSCRIBER', data)
            },
            createField: function (subscriberId) {
                this.fieldSubscriberId = subscriberId
            },
            submitCreateField: function () {
                const data = {
                    subscriber_id: this.fieldSubscriberId,
                    title: this.title,
                    type: this.type,
                };

                this.$store.dispatch('ADD_FIELD', data)
            },
            editField: function (field) {
                this.editedFieldId = field.id
                this.editedTitle = field.title
                this.editedType = field.type
            },
            submitEditedField: function () {
                const data = {
                    id: this.editedFieldId,
                    title: this.editedTitle,
                    type: this.editedType,
                };

                this.$store.dispatch('UPDATE_FIELD', data)
            },
        }
    };
</script>
