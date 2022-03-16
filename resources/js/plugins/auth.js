class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token') !== 'undefined' ? window.localStorage.getItem('token') : null;
        let userData = window.localStorage.getItem('user') !== 'undefined' ? window.localStorage.getItem('user') : null;
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;

            this.getUser();
        }
    }

    login (token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        this.token = token;
        this.user = user;

        Event.$emit('userLoggedIn');
    }

    getUser() {
        axios.get('/api/auth/user').then(r => {
                this.user = r.data;
            }).catch(r => {
                if (r.status === 401) {
                    this.logout();
                }
            });
    }

    logout(vm){
        axios.get('/auth/logout').then(r => {
            this.user = '';
            this.token = '';
            window.localStorage.setItem('token', '');
            window.localStorage.setItem('user', '');
            Event.$emit('userLoggedIn');
            vm.$router.push('login');
        }).catch(r => {
            if (r.status === 401) {
                this.logout();
            }
        });
    }

    check () {
        return !! this.token;
    }
}

export default Auth;
