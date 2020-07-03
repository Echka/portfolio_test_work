<template>
    <div class="block_info">
        <h2>Опыт работы </h2>

        <experience-element v-for="(experience, index) in experiences"
                            v-bind:experience=experience
                            v-bind:key=index
                            v-bind:index=index
                            @close-experience="closeExperience"></experience-element>

        <a href="#" @click="createExperiences">Добавить место работы</a>
    </div>
</template>

<script>
    import ExperienceElement from "./ExperienceElement.vue";

    export default {
        components: {
            ExperienceElement
        },
        data () {
            return {
                "experiences": {}
            }
        },
        methods: {
            createExperiences: function () {
                let experience = {
                    date_start: null,
                    date_finish: null,
                    place_of_work: '',
                    short_description: '',
                    position: ''
                };

                this.experiences.push(experience);
            },
            getExperiences: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/work_experiences/get_list',
                    params: { brief_id: self.$route.params.id }
                })
                    .then(function (response) {

                        if (response.status === 200)
                            self.experiences = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            closeExperience: function (index) {

                this.experiences.splice(index, 1);
            }
        },
        mounted: function () {

            this.getExperiences();
        }
    }
</script>