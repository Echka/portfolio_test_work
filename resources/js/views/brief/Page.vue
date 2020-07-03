<template>
    <div class="card">
        <div class="card-header">Список резюме</div>

        <div class="card-body">
            <brief-list v-bind:briefs=briefs></brief-list>

            <router-link :to="{ name: 'brief.create_update',
                                params: { brief: null }}">Создать резюме</router-link>
        </div>
    </div>
</template>

<script>
    import BriefList from "./component/BriefList"

    export default {
        data () {
            return {
                briefs: []
            }
        },
        components: {
            BriefList
        },
        methods: {
            getBriefs: function () {
                self = this;

                axios.get('/admin/brief/get_list')
                    .then(function (response) {
                        
                        if (response.status === 200)
                            self.briefs = response.data.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        },
        mounted: function () {

            this.getBriefs();
        }
    }
</script>