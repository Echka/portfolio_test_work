<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Тип навыка:</label>
                </div>

                <div class="col-8">
                    <input v-model="skill.type_skill" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label>Описание навыка:</label>

                    <textarea v-model="skill.description_skill" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div v-bind:id="skill.id + 'profSkillU'">
            <button class="btn btn-warning" @click="$emit('update-prof-skill')">Изменить</button>
            <button class="btn btn-info" @click="$emit('set-status-show')">Вернутся к просмотру</button>
        </div>

        <div v-bind:id="skill.id + 'profSkillC'">
            <button class="btn btn-success" @click="$emit('store-prof-skill')">Сохранить</button>
            <button class="btn btn-danger" @click="$emit('close-prof-skill')">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "skill"
        ]
    }
</script>