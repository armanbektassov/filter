<template>
    <div>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">МОИ ЗАДАЧИ</a>
            <form class="form-inline">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input class="form-control my-0 py-1"
                           type="text"
                           @mouseover="showModal = true"
                           placeholder="Фильтр + поиск"
                           aria-label="Search">
                    <div class="input-group-append">
                        <span class="input-group-text"
                              id="basic-text1">
                            <i class="fa fa-search text-grey"
                               aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </form>
        </nav>
        <div class="container">
            <h3>Задачи</h3>

            <div v-if="error"
                 class="alert alert-danger"
                 role="alert">
                {{ error }}
            </div>

            <ul v-if="!loading" class="list-group list-group-flush w-100">
                <li class="list-group-item" v-for="task in tasks" :key="task.id">
                    {{ task.name }}
                </li>
            </ul>
            <div v-else>Загрузка...</div>
        </div>

        <div class="modal my-modal"
             v-if="showModal"
             id="exampleModal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Фильтр</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                @click="showModal = false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"
                         data-spy="scroll"
                         data-offset="10">
                        <form>
                            <div class="form-group">
                                <label>Роль</label>
                                <multiselect v-model="filter.role"
                                             label="name"
                                             track-by="id"
                                             :options="roles"
                                             :multiple="true"
                                             :taggable="true"/>
                            </div>
                            <div class="form-group">
                                <label>Ответственный</label>
                                <multiselect v-model="filter.assigned"
                                             label="name"
                                             track-by="id"
                                             :options="users"
                                             :multiple="true"
                                             :taggable="true"/>
                            </div>
                            <div class="form-group">
                                <label>Постановщик</label>
                                <multiselect v-model="filter.created"
                                             label="name"
                                             track-by="id"
                                             :options="users"
                                             :multiple="true"
                                             :taggable="true"/>
                            </div>
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text"
                                       v-model="filter.name"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Статус</label>
                                <multiselect v-model="filter.status"
                                             label="name"
                                             track-by="id"
                                             :options="statuses"
                                             :multiple="true"
                                             :taggable="true"/>
                            </div>
                            <div class="form-group">
                                <label>Крайний срок</label>
                                <input type="date"
                                       v-model="filter.deadline"
                                       class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                @click="find()"
                                class="btn btn-primary">Найти
                        </button>
                        <button type="button"
                                @click="clear()"
                                class="btn btn-secondary"
                                data-dismiss="modal">Сбросить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import axios from 'axios';
    import _ from 'lodash';

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                loading: false,
                showModal: false,
                users: [],
                tasks: [],
                roles: [],
                filter: {},
                error: null
            }
        },
        methods: {
            getUsers() {
                let _this = this;
                axios.get('/api/users')
                    .then(function (response) {
                        _this.users = response.data.data;
                    })
                    .catch(function (error) {
                        _this.error = error.response.data.message;
                    });
            },
            getTasks() {
                this.loading = true;
                let _this = this, array = [], ids = {};
                _.forEach(this.filter, function (param, key) {
                    if (Array.isArray(param)) {
                        _.forEach(param, function (value) {
                            array.push(value.id);
                        });
                        ids[key] = array;
                    } else {
                        ids[key] = param;
                    }
                    array = [];
                });
                axios.get('/api/tasks', {params: ids})
                    .then(function (response) {
                        _this.tasks = response.data.data;
                    })
                    .catch(function (error) {
                        _this.error = error.response.data.message;
                    })
                    .then(function () {
                        _this.loading = false;
                    });
            },
            getRoles() {
                let _this = this;
                axios.get('/api/roles')
                    .then(function (response) {
                        _this.roles = response.data.data;
                    })
                    .catch(function (error) {
                        _this.error = error.response.data.message;
                    });
            },
            getStatuses() {
                let _this = this;
                axios.get('/api/statuses')
                    .then(function (response) {
                        _this.statuses = response.data.data;
                    })
                    .catch(function (error) {
                        _this.error = error.response.data.message;
                    });
            },
            find() {
                this.showModal = false;
                this.getTasks();
            },
            clear() {
                this.filter = {
                    role: [],
                    assigned: [],
                    created: [],
                    status: [],
                    deadline: null,
                    name: null
                };
            }
        },
        mounted() {
            this.clear();
            this.getUsers();
            this.getTasks();
            this.getRoles();
            this.getStatuses();
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .my-modal {
        display: block;
    }
</style>
