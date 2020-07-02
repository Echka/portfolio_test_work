<template>
    <div class="card">
        <div class="card-header">Профиль</div>

        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>ФИО:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.fio" type="text" class="form-control" name="fio"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>День народження:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.date_of_birth" type="month" class="form-control" name="date_of_birth" min="1980-01">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Город:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.city" type="text" class="form-control" name="city"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Адрес:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.address" type="text" class="form-control" name="address"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Телефон:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.phone" type="text" class="form-control" name="phone"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Email:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="profile.email" type="text" class="form-control" name="email"/>
                    </div>
                </div>
            </div>

            <button class="btn btn-success" @click="updateProfile">Редактировать</button>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        data () {
            return {
                profile: []
            }
        },
        watch: {
            profile: function(newVal, oldVal) {
                this.profile.date_of_birth = moment(newVal.date_of_birth, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM');
            }
        },
        methods: {
            getProfile: function () {
                self = this;

                axios.get('/admin/profile/get')
                    .then(function (response) {

                        if (response.status === 200)
                            self.profile = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateProfile: function () {
                self = this;

                axios({
                    method: 'put',
                    url: '/admin/profile/update/' + this.profile.id,
                    params: this.profile
                })
                    .then(function (response) {

                        if (response.status === 200)
                            self.profile = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.getProfile();
        }
    }
</script>