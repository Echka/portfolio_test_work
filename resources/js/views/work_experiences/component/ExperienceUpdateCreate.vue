<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label>Дата начала:</label>
                    <input v-model="exp.date_start" type="month" class="form-control" min="1980-01">
                </div>

                <div class="col-6">
                    <label>Дата конца:</label>
                    <input v-model="exp.date_finish" type="month" class="form-control" min="1980-01">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Место работы:</label>
                </div>

                <div class="col-8">
                    <input v-model="exp.place_of_work" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Краткое описание:</label>
                </div>

                <div class="col-8">
                    <input v-model="exp.short_description" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Должность:</label>
                </div>

                <div class="col-8">
                    <input v-model="exp.position" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div v-bind:id="exp.id + 'experienceU'">
            <button class="btn btn-warning" @click="$emit('update-experience')">Изменить</button>
            <button class="btn btn-info" @click="$emit('set-status-show')">Вернутся к просмотру</button>
        </div>

        <div v-bind:id="exp.id + 'experienceC'">
            <button class="btn btn-success" @click="$emit('store-experience')">Сохранить</button>
            <button class="btn btn-danger" @click="$emit('close-experience', index)">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "exp"
        ]
    }
</script>