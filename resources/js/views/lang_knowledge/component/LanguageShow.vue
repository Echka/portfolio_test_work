<template>
    <div>
        <h3 class="head_element_h3">{{ lang.language }} - {{ lang.level_lang }}</h3>

        <button class="btn btn-warning" @click="$emit('set-status-update')">Редактировать</button>
        <button class="btn btn-danger" @click="$emit('delete-language')">Удалить</button>
    </div>
</template>

<script>
    export default {
        props: [
            "lang"
        ]
    }
</script>