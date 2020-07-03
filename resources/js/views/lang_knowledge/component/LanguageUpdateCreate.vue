<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Язык:</label>
                </div>

                <div class="col-8">
                    <input v-model="lang.language" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Уровень:</label>
                </div>

                <div class="col-8">
                    <input v-model="lang.level_lang" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div v-bind:id="lang.id + 'languageU'">
            <button class="btn btn-warning" @click="$emit('update-language')">Изменить</button>
            <button class="btn btn-info" @click="$emit('set-status-show')">Вернутся к просмотру</button>
        </div>

        <div v-bind:id="lang.id + 'languageC'">
            <button class="btn btn-success" @click="$emit('store-language')">Сохранить</button>
            <button class="btn btn-danger" @click="$emit('close-language')">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "lang"
        ]
    }
</script>