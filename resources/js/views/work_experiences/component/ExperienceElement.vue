<template>
    <div class="element_of_list">

        <experience-show v-bind:style="{ display: exp.status === 'show' ? 'block' : 'none' }"
                         v-bind:id="exp.id + 'experienceShow'"
                         v-bind:exp=exp
                         @set-status-update="setStatusUpdate"
                         @delete-experience="deleteExperience"></experience-show>

        <experience-u-c v-bind:style="{ display: exp.status === 'show' ? 'none' : 'block' }"
                        v-bind:id="exp.id + 'experienceUC'"
                        v-bind:exp=exp
                        @close-experience="$emit('close-experience', index)"
                        @update-experience="updateExperience"
                        @set-status-show="setStatusShow"
                        @store-experience="storeExperience"></experience-u-c>

    </div>
</template>

<script>
    import ExperienceUC from './ExperienceUpdateCreate'
    import ExperienceShow from './ExperienceShow'

    import moment from 'moment'

    export default {
        props: [
            "experience",
            "index"
        ],
        components: {
            ExperienceUC,
            ExperienceShow
        },
        data () {
            return {
                exp: {}
            }
        },
        methods: {
            showShow: function () {
                let experienceName = '#' + this.exp.id + 'experience';

                $(experienceName + 'Show').show();
                $(experienceName + 'UC').hide();
            },
            showUpdate: function () {
                let experienceName = '#' + this.exp.id + 'experience';

                $(experienceName + 'Show').hide();
                $(experienceName + 'UC').show();
                $(experienceName + 'U').show();
                $(experienceName + 'C').hide();
            },
            showCreate: function () {
                let experienceName = '#' + this.exp.id + 'experience';

                $(experienceName + 'Show').hide();
                $(experienceName + 'UC').show();
                $(experienceName + 'U').hide();
                $(experienceName + 'C').show();
            },
            setStatusShow: function () {
                this.showShow();

                this.exp.status = 'show';
            },
            setStatusUpdate: function () {
                this.showUpdate();

                this.exp.status = 'update';
            },
            setStatusCreate: function () {
                this.showCreate();

                this.exp.status = 'create';
            },
            setNeedFormatDate: function () {
                if (this.exp.date_start != null)
                    this.exp.date_start = moment(this.exp.date_start, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM');

                if (this.exp.date_finish != null)
                    this.exp.date_finish = moment(this.exp.date_finish, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM');
            },
            storeExperience: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/work_experiences/store',
                    params: self.exp
                })
                    .then(function (response) {

                        if (response.status === 201) {
                            self.exp = response.data.data;
                            self.setNeedFormatDate();
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateExperience: function () {
                let self = this;

                axios({
                    method: 'put',
                    url: '/admin/brief/work_experiences/update/' + self.exp.id,
                    params: self.exp
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.exp = response.data.data;
                            self.setNeedFormatDate();
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            deleteExperience: function () {
                let self = this;

                axios({
                    method: 'delete',
                    url: '/admin/brief/work_experiences/destroy/' + self.exp.id,
                    params: self.exp
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.setStatusShow();

                            self.$emit('close-experience', self.index);
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.exp = this.experience;
            this.exp.brief_id = this.$route.params.id;

            this.setNeedFormatDate();


            if (this.exp.id === undefined)
                this.setStatusCreate();

            else if (this.exp.status === undefined)
                this.setStatusShow();
        }
    }
</script>