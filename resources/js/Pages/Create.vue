<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Новая таблица</div>

                <div class="card-body">
                    <form @submit.prevent="submit">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                            <div class="col-md-6">
                                <input v-model="form.name" id="name" type="text" class="form-control">
                                <span class="text-danger">
                                    <strong>{{ errors?.name }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">Фамилия</label>
                            <div class="col-md-6">
                                <input v-model="form.surname" id="surname" type="text" class="form-control">
                                <span class="text-danger">
                                    <strong>{{ errors?.surname }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Телефон</label>
                            <div class="col-md-6 ps-5 position-relative">
                                <div class="position-absolute" style="top:20%; left:15px">+7</div>
                                <input v-model="form.phone" id="phone" type="phone" class="form-control">
                                <span class="text-danger">
                                    <strong>{{ errors?.phone }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">Текст</label>
                            <div class="col-md-6">
                                <textarea v-model="form.content" id="content" class="form-control"></textarea>
                                <span class="text-danger">
                                    <strong>{{ errors?.content }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" 
                                        class="btn btn-primary">
                                    Сохранить
                                </button>
                                <Link :href="route('spreadsheet.index')" class="d-inline-block mx-3">К списку таблиц</Link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'

    export default {
        setup () {
            const form = reactive({
                name: null,
                surname: null,
                phone: null,
                content: null,
            })

            function submit() {
                Inertia.post('/', form)
            }

            return { form, submit }
        },

        props: [ 'errors' ],

        components: {
            Link,
        },
    }
</script>

<style scoped>
</style>