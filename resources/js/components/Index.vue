<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Список таблиц</div>

                <div class="card-body">
                    <p>
                        <router-link :to="{ name: 'create' }" class="btn btn-primary">Создать таблицу</router-link>
                    </p>
                    <ul v-if="spreadsheets" class="list-group">
                        <li v-for="spreadsheet in spreadsheets" class="list-group-item" :key="spreadsheet.id">
                            <a :href="spreadsheet.url">{{ spreadsheet.url }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",

        data() {
            return {
                spreadsheets: null,
            }
        },

        mounted() {
            this.getSpreadsheets()
        },

        methods: {
            getSpreadsheets() {
                axios.get(`/api/spreadsheets`)
                    .then(res => {
                        this.spreadsheets = res.data.result
                    })
                    .catch(err => {
                        console.log(err.response.data.error)
                    })
            },
        },
    }
</script>

<style scoped>
</style>