<template>
    <v-card :loading="loading">
        <v-form ref="form"
                v-model="valid"
                lazy-validation>
            <v-container>
                <v-row class="pt-3" :loading="loading">
                    <v-col cols="4" md="3" class="pb-5 pt-0">
                        <v-autocomplete
                            v-model="form.currency"
                            :items="currencies"
                            item-text="text"
                            item-value="code"
                            label="Currency"
                            :rules="fieldRequired"
                            required
                        ></v-autocomplete>
                    </v-col>
                    <v-col cols="3" md="4" class="pt-5">
                        <datepicker v-model="form.date_from"
                                    title="Date from"
                                    :max="dateFromMax"
                        ></datepicker>
                    </v-col>
                    <v-col cols="3" md="4" class="pt-5">
                        <datepicker v-model="form.date_to"
                                    :min="form.date_from"
                                    :max="dateToMax"
                                    title="Date to"
                        ></datepicker>
                    </v-col>
                    <v-col cols="2" md="1" class="pt-5">
                        <v-btn class="ml-1" depressed color="primary" @click="search">Seacrh</v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-form>
    </v-card>
</template>

<script>

import datepicker from '../../components/form/datepicker';
import moment from 'moment';


export default {
    components:{
        datepicker,
    },
    data () {
        return {
            valid: true,
            fieldRequired: [v => !!v || 'Field is required',],
            loading: false,
            currencies: [],
            form:{
                date_from: moment().add(-15, 'day').format('Y-MM-DD'),
                date_to: moment().add(-10, 'day').format('Y-MM-DD'),
                currency: null,
            },
        }
    },
    watch:{
        'form.date_from': function (val){
            if(val){
                let date = moment(this.form.date_from, 'Y-MM-DD').add(15, 'day').format('Y-MM-DD')
                let maxDate = moment().format('Y-MM-DD');
                this.form.date_to = date <= maxDate ? date : maxDate;
            }
        },
        'form.date_to': function (val){
            if(val && this.form.date_to < this.form.date_from){
                this.form.date_from = moment(this.form.date_to, 'Y-MM-DD').add(-15, 'day').format('Y-MM-DD')
            }
        },
    },
    mounted() {
        this.getCurrencyCode();
    },
    computed: {
        dateFromMax(){
            return moment().format('Y-MM-DD');
        },
        dateToMax(){
            if(this.form.date_from){
                let date = moment(this.form.date_from, 'Y-MM-DD').add(15, 'day').format('Y-MM-DD');
                if(date < moment().format('Y-MM-DD')) return date;
            }

            return moment().format('Y-MM-DD');
        },
    },
    methods: {
        search(){
            if(this.$refs.form.validate()){
                this.$emit('search', this.form);
            }
        },
        getCurrencyCode(){
            this.loading = true;
            this.api.autocomplete.currency().then(r => {
                this.currencies = r.data.data;
                this.loading = false;
            });
        }
    },
}
</script>
