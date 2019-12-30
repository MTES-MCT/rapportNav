// Inspired from Mes Aides UI https://github.com/betagouv/mes-aides-ui
// Licence AGPL, copyright BetaGouv
<template>
    <div v-bind:id="id">
        <input
                type="date"
                v-bind:name="dateName"
                v-bind:id="dateId"
                class="input_date_time__date"
                ref="date"
                aria-label="date"
                v-model="date"
        />
        &nbsp;à&nbsp;
        <input
                type="time"
                v-bind:name="timeName"
                v-bind:id="timeId"
                class="input_date_time__time"
                ref="time"
                aria-label="heure"
                v-model="time"
        />
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        name: 'InputDateTime',
        props: {
            id: String,
            value: String,
            name: String,
        },
        data: function () {
            return {
                currentState: this.value ? 0 : {element: 'day', length: 0},
                date: this.value && moment(this.value).format('YYYY-MM-DD'),
                time: this.value && moment(this.value).format('HH:mm'),
            }
        },
        computed: {
            datetime: function () {
                return `${this.date} ${this.time}`
            },
            dateName: function () {
                return this.name + "[date]"
            },
            timeName: function () {
                return this.name + "[time]"
            },
            dateId: function () {
                return this.id + "_date"
            },
            timeId: function () {
                return this.id + "_time"
            }
        },
        methods: {
            update: function (name) {
                const dt = moment(this.datetime, 'YYY-MM-DD HH:mm', true);
                if (dt.isValid()) {
                    this.$emit('input', this.datetime)
                } else {
                    this.$emit('input', undefined)
                }
            }
        },
        watch: {
            date: function (to) {
                this.update('date')
            },
            time: function (to) {
                this.update('time')
            },
        }
    }
</script>

<style scoped lang="css">
    div {
        align-items: center;
        display: flex;
        flex-direction: row;
    }
    .input_date_time__date {
        width: 9em;
    }
    .input_date_time__time {
        width: 6em;
    }
</style>