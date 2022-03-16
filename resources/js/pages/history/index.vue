<template>
    <div class="page">
        <search-form @search="getHistory"></search-form>
        <v-card class="my-5">
            <v-data-table
                :loading="loading"
                :headers="headers"
                :items="items"
                :search="search"
            >
                <template v-slot:item.difference="{ item }">
                    <v-chip
                        class="chip-rate"
                        :color="getColors(item.sign)"
                        label
                        text-color="white"
                        center
                        v-if="item.difference != null"
                    >
                       {{item.sign}} {{ item.difference }} <v-icon>{{item.sign === '+' ? 'mdi-arrow-up' : 'mdi-arrow-down'}}</v-icon>
                    </v-chip>
                </template>
            </v-data-table>

        </v-card>

        <v-card v-if="items.length">
            <v-sparkline
                line-width="1"
                padding="20"
                smooth="0"
                :value="rates"
                auto-draw
            >
                <template v-slot:label="item">
                    {{ item.value }}
                </template>

            </v-sparkline>
        </v-card>
    </div>
</template>

<script>
import searchForm from './form';
import moment from "moment";

export default {
    components:{
        searchForm
    },
    data () {
        return {
            loading: false,
            search: '',
            headers: [
                { text: 'Date', value: 'exchange_date',},
                { text: 'Rate', value: 'rate', filterable: false,},
                { text: 'Difference', value: 'difference', filterable: false,},
            ],
            items: [],
        }
    },
    computed: {
        rates(){
            if(this.items.length){
                return this.items.map(i => {
                    return Number(i.rate.toFixed(2));
                });
            }

            return [];
        },
    },
    methods: {
        getColors(sign){

            if(sign){
                return sign === '+' ? 'green' : 'red';
            }
            return 'primary'
        },
        getHistory(params){
            this.items = [];
            this.loading = true;
            this.api.course.history(params).then(r => {
                this.items = r.data.data;
                this.loading = false;
            });
        },
    },
}
</script>
