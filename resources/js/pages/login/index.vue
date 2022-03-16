<template>
    <div class="page">
        <v-card class="mx-auto my-12" max-width="500">
            <v-card-text>
                <v-form>
                    <v-text-field label="Email"
                                  v-model="form.email"
                                  required
                                  :rules="[v => !!v || 'Email is required']"
                    ></v-text-field>
                    <v-text-field label="Password"
                                  v-model="form.password"
                                  type="password"
                                  required
                                  :rules="[v => !!v || 'Password is required']"
                    ></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions class="d-flex justify-end">
                <v-btn color="primary" @click="login">Login</v-btn>
            </v-card-actions>
        </v-card>
        <v-overlay :value="loading">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                loading: false,
                form: {
                    email: '',
                    password: '',
                },
            }
        },
        methods: {
            login() {
                this.loading = true
                this.api.user.login(this.form).then(r => {
                    auth.login(r.data.access_token, r.data.user);
                    this.$router.push('/course');
                    this.loading = false
                }).catch(r => {
                    console.log(r);
                    // alert(r.data.message);
                    this.loading = false
                });
            }
        }
    }
</script>
