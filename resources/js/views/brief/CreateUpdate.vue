<template>
    <div class="card">
        <div class="card-header">
            {{ this.$route.params.brief == null ? 'Создание резюме' : 'Редактирование резюме' }}
        </div>

        <div class="card-body">

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Посада:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="brief.position" type="text" class="form-control" name="position"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Желаемая з/п:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="brief.salary" type="number" class="form-control" name="salary"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-4">
                        <label>Город:</label>
                    </div>

                    <div class="col-8">
                        <input v-model="brief.city" type="text" class="form-control" name="city"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <label>Дополнительная информация:</label>

                        <textarea v-model="brief.additional_info" class="form-control" name="additional_info"></textarea>
                    </div>
                </div>
            </div>

            <button class="btn btn-success" @click="detectNeedMethod">
                {{ this.$route.params.brief == null ? 'Создать' : 'Редактировать' }}
            </button>

            <div>
                <router-link :to="{ name: 'brief' }">Вернутся</router-link>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data () {
            return {
                brief: {
                    "position": "",
                    "salary": 0,
                    "city": "",
                    "additional_info": ""
                }
            }
        },
        methods: {
            detectNeedMethod() {

                if (this.$route.params.brief !== null)
                    this.updateBrief();
                else
                    this.storeBrief();
            },
            getBrief: function () {

                self = this;

                let brief_id = this.$route.params.id;

                axios({
                    method: 'get',
                    url: '/admin/brief/get/' + brief_id,
                    params: self.brief
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.brief = response.data.data;
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            storeBrief: function () {
                self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/store',
                    params: self.brief
                })
                    .then(function (response) {

                        if (response.status === 201) {
                            self.$router.push({ name: 'brief' });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateBrief: function () {
                self = this;

                axios({
                    method: 'put',
                    url: '/admin/brief/update/' + self.brief.id,
                    params: self.brief
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.$router.push({
                                name: 'brief.show',
                                params: {
                                    brief: self.brief,
                                    id: self.brief.id
                                }
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            if (this.$route.params.brief != null && this.$route.params.brief !== undefined)
                this.brief = this.$route.params.brief;
            else
                this.getBrief();
        }
    }
</script>