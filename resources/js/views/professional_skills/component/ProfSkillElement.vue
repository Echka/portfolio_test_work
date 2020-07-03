<template>
    <div class="element_of_list">

        <prof-skill-show v-bind:style="{ display: skill.status === 'show' ? 'block' : 'none' }"
                         v-bind:id="skill.id + 'profSkillShow'"
                         v-bind:skill=skill
                         @set-status-update="setStatusUpdate"
                         @delete-prof-skill="deleteProfSkill"></prof-skill-show>

        <prof-skill-u-c v-bind:style="{ display: skill.status === 'show' ? 'none' : 'block' }"
                        v-bind:id="skill.id + 'profSkillUC'"
                        v-bind:skill=skill
                        @close-prof-skill="$emit('close-prof-skill', index)"
                        @update-prof-skill="updateProfSkill"
                        @set-status-show="setStatusShow"
                        @store-prof-skill="storeProfSkill"></prof-skill-u-c>

    </div>
</template>

<script>
    import ProfSkillUC from './ProfSkillUpdateCreate'
    import ProfSkillShow from './ProfSkillShow'

    export default {
        props: [
            "profSkill",
            "index"
        ],
        components: {
            ProfSkillUC,
            ProfSkillShow
        },
        data () {
            return {
                skill: {}
            }
        },
        methods: {
            showShow: function () {
                let profSkillName = '#' + this.skill.id + 'profSkill';

                $(profSkillName + 'Show').show();
                $(profSkillName + 'UC').hide();
            },
            showUpdate: function () {
                let profSkillName = '#' + this.skill.id + 'profSkill';

                $(profSkillName + 'Show').hide();
                $(profSkillName + 'UC').show();
                $(profSkillName + 'U').show();
                $(profSkillName + 'C').hide();
            },
            showCreate: function () {
                let profSkillName = '#' + this.skill.id + 'profSkill';

                $(profSkillName + 'Show').hide();
                $(profSkillName + 'UC').show();
                $(profSkillName + 'U').hide();
                $(profSkillName + 'C').show();
            },
            setStatusShow: function () {
                this.showShow();

                this.skill.status = 'show';
            },
            setStatusUpdate: function () {
                this.showUpdate();

                this.skill.status = 'update';
            },
            setStatusCreate: function () {
                this.showCreate();

                this.skill.status = 'create';
            },
            storeProfSkill: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/prof_skill/store',
                    params: self.skill
                })
                    .then(function (response) {

                        if (response.status === 201) {
                            self.skill = response.data.data;
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateProfSkill: function () {
                let self = this;

                axios({
                    method: 'put',
                    url: '/admin/brief/prof_skill/update/' + self.skill.id,
                    params: self.skill
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.skill = response.data.data;
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            deleteProfSkill: function () {
                let self = this;

                axios({
                    method: 'delete',
                    url: '/admin/brief/prof_skill/destroy/' + self.skill.id,
                    params: self.skill
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.setStatusShow();

                            self.$emit('close-prof-skill', self.index);
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.skill = this.profSkill;
            this.skill.brief_id = this.$route.params.id;

            if (this.skill.id === undefined)
                this.setStatusCreate();

            else if (this.skill.status === undefined)
                this.setStatusShow();
        }
    }
</script>