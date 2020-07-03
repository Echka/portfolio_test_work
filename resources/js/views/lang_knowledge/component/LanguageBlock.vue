<template>
    <div class="block_info">
        <h2>Языки </h2>

        <language-element v-for="(language, index) in languages"
                            v-bind:language=language
                            v-bind:key=index
                            v-bind:index=index
                            @close-language="closeLanguage"></language-element>

        <a href="#" @click="createLanguage">Добавить язык</a>
    </div>
</template>

<script>
    import LanguageElement from "./LanguageElement.vue";

    export default {
        components: {
            LanguageElement
        },
        data () {
            return {
                "languages": []
            }
        },
        methods: {
            createLanguage: function () {
                let lang = {
                    language: '',
                    level_lang: ''
                };

                this.languages.push(lang);
            },
            getLanguages: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/lang_knowledge/get_list',
                    params: { brief_id: self.$route.params.id }
                })
                    .then(function (response) {

                        if (response.status === 200)
                            self.languages = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            closeLanguage: function (index) {

                this.languages.splice(index, 1);
            }
        },
        mounted: function () {

            this.getLanguages();
        }
    }
</script>