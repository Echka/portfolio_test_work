<template>
    <tr>
        <td>{{ brief.position }}</td>
        <td>{{ brief.salary }}</td>
        <td>{{ brief.city }}</td>
        <td>
            <button class="btn btn-info">Просмотр</button>
            <router-link class="btn btn-warning"
                         :to="{ name: 'brief.create_update',
                                params: { brief: brief }}">Изменить</router-link>
            <button @click="deleteBrief(brief.id, index)" class="btn btn-danger">Удалить</button>
        </td>
    </tr>
</template>

<script>
    export default {
        name: 'brief',
        props: [
            "brief",
            "index"
        ],
        watch: {
            brief: function(newVal, oldVal) { // watch it
                this.brief = newVal;
            }
        },
        methods: {
            deleteBrief: function (id, index) {
                self = this;

                axios({
                    method: 'delete',
                    url: '/admin/brief/destroy/' + id
                })
                    .then(function (response) {

                        if (response.status === 200) {
                            self.$emit('remove-brief', index)
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }
        }
    }
</script>