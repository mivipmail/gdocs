<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Новая таблица</div>

                <div class="card-body">
                    <form method="POST" action="">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>
                            <div class="col-md-6">
                                <input v-model="name" id="name" type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">Фамилия</label>
                            <div class="col-md-6">
                                <input v-model="surname" id="surname" type="text" class="form-control" name="surname">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Телефон</label>
                            <div class="col-md-6 ps-5 position-relative">
                                <div class="position-absolute" style="top:20%; left:15px">+7</div>
                                <input v-model="phone" id="phone" type="phone" class="form-control" name="phone">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">Текст</label>
                            <div class="col-md-6">
                                <textarea v-model="content" id="content" class="form-control" name="content"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-md-4 col-md-6">
                                <span class="text-danger">
                                    <strong>{{ this.error }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="store" 
                                        :disabled="!validateRequired"
                                        type="submit" 
                                        class="btn btn-primary">
                                    Сохранить
                                </button>
                                <router-link :to="{ name: 'index' }" class="d-inline-block mx-3">К списку таблиц</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Create",

        data() {
            return {
                name: null,
                surname: null,
                phone: null,
                content: null,
                error: null,
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

            store() {
                this.error = null
                if(!this.validatePhone) {
                    this.error = 'Пожалуйста, проверьте корректность номера мобильного телефона.'
                    return
                }
                
                axios.post(`/api/spreadsheets`, {
                        name: this.name,
                        surname: this.surname,
                        phone: this.phone,
                        content: this.content,
                    }
                )
                    .then(res => {
                        this.$router.push({name: 'index'})
                    })
                    .catch(err => {
                        console.log(err.response.data.error)
                    })
            },
        },

        computed: {
            validateRequired() {
                return this.name && this.surname && this.phone && this.content
            },

            validatePhone() {
                return /^\(?([9][0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{2})[-. ]?([0-9]{2})$/i.test(this.phone.replace(/\s/g, ''))
            },
        },
    }
</script>

<style scoped>
</style>