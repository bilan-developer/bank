<template>
    <v-menu ref="menu" v-model="isOpen" :close-on-content-click="false" transition="scale-transition" offset-y min-width="auto">
        <template v-slot:activator="{ on, attrs }">
            <v-text-field v-model="date" dense :label="title" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
        </template>
        <v-date-picker v-model="date" :min="min" :max="max" no-title scrollable required>
            <v-spacer></v-spacer>
        </v-date-picker>
    </v-menu>
</template>

<script>
export default {
    props:['value', 'title', 'max', 'min'],
    data () {
        return {
            date: this.value,
            isOpen: false,
        }
    },
    watch:{
        date: function (val){
            this.$emit('input', val)
        },
        value: function (val){
            this.date = val;
        }
    },

}
</script>
