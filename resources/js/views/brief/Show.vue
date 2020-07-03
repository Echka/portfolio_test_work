<template>
    <div class="card">
        <div class="card-header">Резюме</div>

        <div class="card-body">
            <brief-block v-bind:brief=brief></brief-block>

            <profile-block v-bind:brief=brief></profile-block>

            <experience-block></experience-block>

            <education-block></education-block>

            <prof-skill-block></prof-skill-block>

            <language-block></language-block>

            <div>
                <router-link :to="{ name: 'brief' }">Вернутся</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import BriefBlock from "./component/BriefShowBlock"
    import ProfileBlock from "../profile/component/ProfileShowBlock"
    import ExperienceBlock from "../work_experiences/component/ExperienceBlock"
    import EducationBlock from "../education/component/EducationBlock"
    import ProfSkillBlock from "../professional_skills/component/ProfSkillBlock"
    import LanguageBlock from "../lang_knowledge/component/LanguageBlock"

    export default {
        components: {
            BriefBlock,
            ProfileBlock,
            ExperienceBlock,
            EducationBlock,
            ProfSkillBlock,
            LanguageBlock
        },
        data () {
            return {
                brief: {}
            }
        },
        methods: {
            getBrief: function () {

                self = this;

                let brief_id = this.$route.params.id;

                axios({
                    method: 'get',
                    url: '/admin/brief/get/' + brief_id,
                    params: this.brief
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