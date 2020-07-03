<template>
    <div class="element_of_list">

        <language-show v-bind:style="{ display: lang.status === 'show' ? 'block' : 'none' }"
                         v-bind:id="lang.id + 'languageShow'"
                         v-bind:lang=lang
                         @set-status-update="setStatusUpdate"
                         @delete-language="deleteLanguage"></language-show>

        <language-u-c v-bind:style="{ display: lang.status === 'show' ? 'none' : 'block' }"
                        v-bind:id="lang.id + 'languageUC'"
                        v-bind:lang=lang
                        @close-language="$emit('close-language', index)"
                        @update-language="updateLanguage"
                        @set-status-show="setStatusShow"
                        @store-language="storeLanguage"></language-u-c>

    </div>
</template>

<script>
    import LanguageUC from './LanguageUpdateCreate'
    import LanguageShow from './LanguageShow'

    export default {
        props: [
            "language",
            "index"
        ],
        components: {
            LanguageUC,
            LanguageShow
        },
        data () {
            return {
                lang: {}
            }
        },
        methods: {
            showShow: function () {
                let languageName = '#' + this.lang.id + 'language';

                $(languageName + 'Show').show();
                $(languageName + 'UC').hide();
            },
            showUpdate: function () {
                let languageName = '#' + this.lang.id + 'language';

                $(languageName + 'Show').hide();
                $(languageName + 'UC').show();
                $(languageName + 'U').show();
                $(languageName + 'C').hide();
            },
            showCreate: function () {
                let languageName = '#' + this.lang.id + 'language';

                $(languageName + 'Show').hide();
                $(languageName + 'UC').show();
                $(languageName + 'U').hide();
                $(languageName + 'C').show();
            },
            setStatusShow: function () {
                this.showShow();

                this.lang.status = 'show';
            },
            setStatusUpdate: function () {
                this.showUpdate();

                this.lang.status = 'update';
            },
            setStatusCreate: function () {
                this.showCreate();

                this.lang.status = 'create';
            },
            storeLanguage: function () {
                let self = this;

                axios({
                    method: 'get',
                    url: '/admin/brief/lang_knowledge/store',
                    params: self.lang
                })
                    .then(function (response) {

                        if (response.status === 201) {
                            self.lang = response.data.data;
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            updateLanguage: function () {
                let self = this;

                axios({
                    method: 'put',
                    url: '/admin/brief/lang_knowledge/update/' + self.lang.id,
                    params: self.lang
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.lang = response.data.data;
                            self.setStatusShow();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            deleteLanguage: function () {
                let self = this;

                axios({
                    method: 'delete',
                    url: '/admin/brief/lang_knowledge/destroy/' + self.lang.id,
                    params: self.lang
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.setStatusShow();

                            self.$emit('close-language', self.index);
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.lang = this.language;
            this.lang.brief_id = this.$route.params.id;

            if (this.lang.id === undefined)
                this.setStatusCreate();

            else if (this.lang.status === undefined)
                this.setStatusShow();
        }
    }
</script>