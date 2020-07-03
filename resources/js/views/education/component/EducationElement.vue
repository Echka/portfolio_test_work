<template>
    <div class="element_of_list">

        <education-show v-bind:style="{ display: educ.status === 'show' ? 'block' : 'none' }"
                         v-bind:id="educ.id + 'educationShow'"
                         v-bind:educ=educ
                         @set-status-update="setStatusUpdate"
                         @delete-education="deleteEducation"></education-show>

        <education-u-c v-bind:style="{ display: educ.status === 'show' ? 'none' : 'block' }"
                        v-bind:id="educ.id + 'educationUC'"
                        v-bind:educ=educ
                        @close-education="$emit('close-education', index)"
                        @update-education="updateEducation"
                        @set-status-show="setStatusShow"
                        @store-education="storeEducation"></education-u-c>

    </div>
</template>

<script>
    import EducationUC from './EducationUpdateCreate'
    import EducationShow from './EducationShow'

    import moment from 'moment'

    export default {
        props: [
            "education",
            "index"
        ],
        components: {
            EducationUC,
            EducationShow
        },
        data () {
            return {
                educ: {}
            }
        },
        methods: {
            showShow: function () {
                let educationName = '#' + this.educ.id + 'education';

                $(educationName + 'Show').show();
                $(educationName + 'UC').hide();
            },
            showUpdate: function () {
                let educationName = '#' + this.educ.id + 'education';

                $(educationName + 'Show').hide();
                $(educationName + 'UC').show();
                $(educationName + 'U').show();
                $(educationName + 'C').hide();
            },
            showCreate: function () {
                let educationName = '#' + this.educ.id + 'education';

                $(educationName + 'Show').hide();
                $(educationName + 'UC').show();
                $(educationName + 'U').hide();
                $(educationName + 'C').show();
            },
            setStatusShow: function () {
                this.showShow();

                this.educ.status = 'show';
            },
            setStatusUpdate: function () {
                this.showUpdate();

                this.educ.status = 'update';
            },
            setStatusCreate: function () {
                this.showCreate();

                this.educ.status = 'create';
            },
            setNeedFormatDate: function () {
                if (this.educ.date_start != null)
                    this.educ.date_start = moment(this.educ.date_start, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM');

                if (this.educ.date_finish != null)
                    this.educ.date_finish = moment(this.educ.date_finish, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM');
            },
            storeEducation: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/education/store',
                    params: self.educ
                })
                    .then(function (response) {

                        if (response.status === 201) {
                            self.educ = response.data.data;
                            self.setNeedFormatDate();
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateEducation: function () {
                let self = this;

                axios({
                    method: 'put',
                    url: '/admin/brief/education/update/' + self.educ.id,
                    params: self.educ
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.educ = response.data.data;
                            self.setNeedFormatDate();
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            deleteEducation: function () {
                let self = this;

                axios({
                    method: 'delete',
                    url: '/admin/brief/education/destroy/' + self.educ.id,
                    params: self.educ
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.setStatusShow();

                            self.$emit('close-education', self.index);
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.educ = this.education;
            this.educ.brief_id = this.$route.params.id;

            this.setNeedFormatDate();


            if (this.educ.id === undefined)
                this.setStatusCreate();

            else if (this.educ.status === undefined)
                this.setStatusShow();
        }
    }
</script>