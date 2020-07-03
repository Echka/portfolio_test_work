<template>
    <div>
        <h3 class="head_element_h3">{{ exp.position }}</h3>

        <p>с {{ exp.date_start }} по {{ finishDate }} {{ getDifferenceDate }}<br />
            Место работы: {{ exp.place_of_work }}</p>

        <p>{{ exp.short_description }}</p>

        <button class="btn btn-warning" @click="$emit('set-status-update')">Редактировать</button>
        <button class="btn btn-danger" @click="$emit('delete-experience')">Удалить</button>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: [
            "exp"
        ],
        computed: {
            getDifferenceDate: function () {

                var monthDifference = '';

                if (this.exp.date_start != null) {
                    var a, b;

                    a = moment(this.exp.date_start, 'YYYY-MM');

                    if (this.exp.date_finish == null)
                        b = moment();
                    else
                        b = moment(this.exp.date_finish, 'YYYY-MM');

                    var years = b.diff(a, 'year');
                    a.add(years, 'years');

                    var months = b.diff(a, 'months');
                    a.add(months, 'months');

                    monthDifference = '(' + (years > 0 ? years + ' год ' : '') + months + ' месяц' + ')';
                }

                return monthDifference;
            },
            finishDate: function () {
                return this.exp.date_finish == null
                    ? 'наст. время'
                    : this.exp.date_finish;
            }
        }
    }
</script>