<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <label>Дата начала:</label>
                    <input v-model="educ.date_start" type="month" class="form-control" min="1980-01">
                </div>

                <div class="col-6">
                    <label>Дата конца:</label>
                    <input v-model="educ.date_finish" type="month" class="form-control" min="1980-01">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Место образования:</label>
                </div>

                <div class="col-8">
                    <input v-model="educ.title" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Специальность:</label>
                </div>

                <div class="col-8">
                    <input v-model="educ.specialty" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Город:</label>
                </div>

                <div class="col-8">
                    <input v-model="educ.city" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label>Степень образования:</label>
                </div>

                <div class="col-8">
                    <input v-model="educ.type_of_education" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div v-bind:id="educ.id + 'educationU'">
            <button class="btn btn-warning" @click="$emit('update-education')">Изменить</button>
            <button class="btn btn-info" @click="$emit('set-status-show')">Вернутся к просмотру</button>
        </div>

        <div v-bind:id="educ.id + 'educationC'">
            <button class="btn btn-success" @click="$emit('store-education')">Сохранить</button>
            <button class="btn btn-danger" @click="$emit('close-education')">Закрыть</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "educ"
        ]
    }
</script>