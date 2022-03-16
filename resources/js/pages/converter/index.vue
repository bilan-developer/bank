<template>
    <div class="page">
        <search-form @search="convert"></search-form>
        <v-card :loading="loading" class="my-5">

            <div class="text-center">
                <v-chip class="ma-2"
                        color="green"
                        label
                        text-color="white">
                    <span v-if="form.amount">{{ form.amount }} {{ form.currency }}</span>
                </v-chip>
                <v-chip class="ma-2"
                        color="primary"
                        label
                        text-color="white">
                    =
                </v-chip>
                <v-chip class="ma-2"
                        color="green"
                        label
                        text-color="white">
                    <span v-if="result">{{ result }} UAN</span>
                </v-chip>
            </div>
        </v-card>
    </div>
</template>

<script>
import searchForm from './form';

export default {
    components:{
        searchForm
    },
    data () {
        return {
            loading: false,
            result: null,
            form: {}
        }
    },
    methods: {
        getColors(sign){
            if(sign){
                return sign === '+' ? 'green' : 'red';
            }
            return 'primary'
        },
        convert(params){
            this.form = params;
            this.loading = true;
            this.result = null;
            this.api.course.convert(params).then(r => {
                this.result = r.data.data.amount;
                this.loading = false;
            }).catch(e => {
                alert('Error')
            });
        },
    },
}
</script>
