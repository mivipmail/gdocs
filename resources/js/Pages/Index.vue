<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Список таблиц</div>
                <div class="card-body">
                    <p>
                        <Link :href="route('spreadsheet.create')" class="btn btn-primary">Создать таблицу</Link>
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
    import { Link } from '@inertiajs/inertia-vue3'

    export default {
        props: [
            'spreadsheets'
        ],

        components: {
            Link,
        },
    }
</script>

<style scoped>
</style>