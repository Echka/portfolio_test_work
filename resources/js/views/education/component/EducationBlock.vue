<template>
    <div class="block_info">
        <h2>Образование </h2>

        <education-element v-for="(education, index) in educations"
                            v-bind:education=education
                            v-bind:key=index
                            v-bind:index=index
                            @close-education="closeEducation"></education-element>

        <a href="#" @click="createEducation">Добавить место обучения</a>
    </div>
</template>

<script>
    import EducationElement from "./EducationElement.vue";

    export default {
        components: {
            EducationElement
        },
        data () {
            return {
                "educations": []
            }
        },
        methods: {
            createEducation: function () {
                let education = {
                    date_start: null,
                    date_finish: null,
                    specialty: '',
                    city: '',
                    type_of_education: ''
                };

                this.educations.push(education);
            },
            getEducation: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/education/get_list',
                    params: { brief_id: self.$route.params.id }
                })
                    .then(function (response) {

                        if (response.status === 200)
                            self.educations = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            closeEducation: function (index) {

                this.educations.splice(index, 1);
            }
        },
        mounted: function () {

            this.getEducation();
        }
    }
</script>