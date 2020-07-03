<template>
    <div class="block_info">
        <h2>Навыки </h2>

        <prof-skill-element v-for="(profSkill, index) in profSkills"
                            v-bind:profSkill=profSkill
                            v-bind:key=index
                            v-bind:index=index
                            @close-prof-skill="closeProfSkill"></prof-skill-element>

        <a href="#" @click="createProfSkill">Добавить навык</a>
    </div>
</template>

<script>
    import ProfSkillElement from "./ProfSkillElement.vue";

    export default {
        components: {
            ProfSkillElement
        },
        data () {
            return {
                "profSkills": []
            }
        },
        methods: {
            createProfSkill: function () {
                let profSkill = {
                    type_skill: '',
                    description_skill: ''
                };

                this.profSkills.push(profSkill);
            },
            getProfSkills: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/prof_skill/get_list',
                    params: { brief_id: self.$route.params.id }
                })
                    .then(function (response) {

                        if (response.status === 200)
                            self.profSkills = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            closeProfSkill: function (index) {

                this.profSkills.splice(index, 1);
            }
        },
        mounted: function () {

            this.getProfSkills();
        }
    }
</script>