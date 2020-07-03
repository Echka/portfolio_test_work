<template>
    <div class="block_info">
        <h3>ФИО: {{ profile.fio }} <router-link class="text_edit_link" :to="{ name: 'profile' }">Редактирование профиля</router-link></h3>
        <p>Дата рождения: {{ getDataBirth }}</p>
        <p>Город: {{ profile.city }}</p>
        <p>Адрес: {{ profile.address }}</p>
        <p>Телефон: {{ profile.phone }}</p>
        <p>Email: {{ profile.email }}</p>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: [
            "brief"
        ],
        data () {
            return {
                "profile": {}
            }
        },
        watch: {
            brief: function brief(newVal, oldVal) {
                // watch it
                this.getProfile();
            }
        },
        computed: {
            getDataBirth: function () {
                let date = 'Не вказано';

                if (this.profile.date_of_birth !== undefined && this.profile.date_of_birth != null)
                    date = moment(this.profile.date_of_birth, 'YYYY-MM-DD HH:mm:ss').format('MM-YYYY');

                return date;
            }
        },
        methods: {
            getProfile: function () {
                let self = this;

                if (self.brief.user_id === undefined)
                    return;

                axios.get('/admin/profile/get_by_user/' + self.brief.user_id)
                    .then(function (response) {

                        if (response.status === 200)
                            self.profile = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
        },
        mounted: function () {

            this.getProfile();
        }
    }
</script>