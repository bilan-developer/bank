import Vue from "vue"
import VueRouter from 'vue-router'
Vue.use(VueRouter);


let routes = [];

// Login page
routes.push({
    path: '/login',
    name: 'login',
    component: require('./pages/login/index.vue').default,
    meta: {title: 'Login',}
});




// Course for today
routes.push({
    path: '/course',
    name: 'course',
    component: require('./pages/course/index.vue').default,
    meta: {
        title: 'Course for today',
        middlewareAuth: true
    }
});

// Converter
routes.push({
    path: '/converter',
    name: 'converter',
    component: require('./pages/converter/index.vue').default,
    meta: {
        title: 'Converter',
        middlewareAuth: true
    }
});


// History change currency
routes.push({
    path: '/history',
    name: 'history',
    component: require('./pages/history/index.vue').default,
    meta: {
        title: 'History change currency',
        middlewareAuth: true
    }
});
routes.push({
    path: '/',
    redirect: { name: 'course' },
});


const r = new VueRouter({
    mode: 'history',
    routes: routes

});


r.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {
        if (!auth.check()) {
            next({
                path: '/login',
            });

            return;
        }
    }

    document.title = to.meta.title + ' - Bravo Touristic'
    next()
});


export default r;
