<template>
    <div class="block_info">
        <h3>{{ brief.position }}, <span class="price_span">{{ brief.salary }} грн</span>
            <router-link class="text_edit_link"
                         :to="{ name: 'brief.create_update',
                                params: { brief: brief,
                                          id: brief.id }}">Редактирование резюме</router-link></h3>
        <p>Город: {{ brief.city }}</p>
        <p>Дополнительная информация:</p>
        <p>{{ brief.additional_info }}</p>
    </div>
</template>

<script>
    export default {
        props: [
            "brief"
        ]
    }
</script>