<template>
    <div>
        <h3 class="head_element_h3">{{ educ.title }}</h3>

        <p>{{ educ.specialty }}, {{ educ.city }}<br />
           {{ educ.type_of_education }}, с {{ educ.date_start }} по {{ finishDate }} {{ getDifferenceDate }}</p>

        <button class="btn btn-warning" @click="$emit('set-status-update')">Редактировать</button>
        <button class="btn btn-danger" @click="$emit('delete-education')">Удалить</button>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: [
            "educ"
        ],
        computed: {
            getDifferenceDate: function () {

                var monthDifference = '';

                if (this.educ.date_start != null) {
                    var a, b;

                    a = moment(this.educ.date_start, 'YYYY-MM');

                    if (this.educ.date_finish == null)
                        b = moment();
                    else
                        b = moment(this.educ.date_finish, 'YYYY-MM');

                    var years = b.diff(a, 'year');
                    a.add(years, 'years');

                    var months = b.diff(a, 'months');
                    a.add(months, 'months');

                    monthDifference = '(' + (years > 0 ? years + ' год ' : '') + months + ' месяц' + ')';
                }

                return monthDifference;
            },
            finishDate: function () {
                return this.educ.date_finish == null
                    ? 'наст. время'
                    : this.educ.date_finish;
            }
        }
    }
</script>