<template>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Посада</th>
            <th>з\п</th>
            <th>Город</th>
            <th>Действия</th>
        </tr>
        </thead>

        <tbody>
            <brief-block v-for="(brief, index) in briefsList"
                         v-bind:brief=brief
                         v-bind:key=index
                         v-bind:index=index
                         @remove-brief="removeBrief"></brief-block>
        </tbody>
    </table>
</template>

<script>
    import BriefBlock from "./BriefTrBlock"

    export default {
        name: 'brief-list',
        components: {
            BriefBlock
        },
        props: [
            "briefs"
        ],
        data () {
            return {
                briefsList: this.briefs
            }
        },
        watch: {
            briefs: function(newVal, oldVal) { // watch it
                this.briefsList = newVal;
            }
        },
        methods: {
            removeBrief: function(index) {

                this.briefsList.splice(index, 1);
            }
        }
    }
</script>