<template>
    <v-card :loading="loading">
        <v-form ref="form"
                v-model="valid"
                lazy-validation>
            <v-container>
                <v-row class="pt-3" :loading="loading">
                    <v-col cols="4" md="4" class="pb-5 pt-0">
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
                    <v-col cols="3" md="3" class="pb-5 pt-0">
                        <v-text-field
                            label="Amount"
                            type="number"
                            v-model="form.amount"
                            :rules="fieldRequired"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="3" md="4" class="pt-5">
                        <datepicker v-model="form.date"
                                    title="Date"
                                    :max="dateMax"
                        ></datepicker>
                    </v-col>
                    <v-col cols="2" md="1" class="pt-5">
                        <v-btn class="ml-1" depressed color="primary" @click="search">Convert</v-btn>
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
                date: moment().add(-15, 'day').format('Y-MM-DD'),
                amount: 1,
                currency: null,
            },
        }
    },

    mounted() {
        this.getCurrencyCode();
    },
    computed: {
        dateMax(){
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
