<template>
    <section class="mailerlite-app">
        <header class="header mb-3">
            <h1>Subscribers</h1>
        </header>
        <add-subscriber></add-subscriber>
        <subscriber-list></subscriber-list>
    </section>
</template>
<script>
    import SubscriberList from './SubscriberList'
    import AddSubscriber from './AddSubscriber'

    export default {
        name: "MailerliteApp",
        components: {
            SubscriberList,
            AddSubscriber
        },
        mounted() {
            this.$store.dispatch('GET_SUBSCRIBERS')
        }
    };
</script>
