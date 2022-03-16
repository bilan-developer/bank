const api = {
    install(Vue, options) {
        Vue.mixin({
            data() {
                return {
                    api: {
                        user: require('./api/user.js').default,
                        course: require('./api/course.js').default,
                        autocomplete: require('./api/autocomplete.js').default,
                    }
                }
            },
        });
    }

}

export default api
