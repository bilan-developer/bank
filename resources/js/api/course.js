export default {
    get() {return axios.get(`/course`)},
    history(params) {return axios.get(`/course/history`, {params: params})},
    convert(params) {return axios.get(`/course/convert`, {params: params})},
}
