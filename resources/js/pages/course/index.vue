<template>
    <div class="page">
        <v-card>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :loading="loading"
                :headers="headers"
                :items="items"
                :search="search"
            ></v-data-table>
        </v-card>
    </div>
</template>

<script>

export default {
    components:{
    },
    data () {
        return {
            loading: false,
            search: '',
            headers: [
                { text: 'Code', filterable: false, value: 'code',},
                { text: 'Name', value: 'name' },
                { text: 'Rate', value: 'rate', filterable: false,},
                { text: 'Exchange date', value: 'exchange_date', filterable: false, },
            ],
            items: [],
        }
    },
    mounted() {
        this.getCourses();
    },
    methods: {
        getCourses(){
            this.loading = true;
            this.api.course.get().then(r => {
                this.items = r.data.data;
                this.loading = false;
            });
        },
    },
}
</script>
