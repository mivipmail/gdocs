<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",

        data() {
            return {
            }
        },

        watch: {
            $route(to, from) {
            }
        },

        mounted() {
        },

        methods: {
            init() {
            },
        },
    }
</script>

<style scoped>
</style>