<template>
    <div>
        <h3 class="head_element_h3">{{ skill.type_skill }}</h3>

        <div v-html=skill.description_skill></div>

        <button class="btn btn-warning" @click="$emit('set-status-update')">Редактировать</button>
        <button class="btn btn-danger" @click="$emit('delete-prof-skill')">Удалить</button>
    </div>
</template>

<script>
    export default {
        props: [
            "skill"
        ]
    }
</script>