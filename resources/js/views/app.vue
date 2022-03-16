<template>
    <v-app id="inspire">
        <v-navigation-drawer v-if="authenticated" v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
            <v-list dense>
                <template v-for="item in items">
                    <v-list-item :key="item.title" :to="item.route" link>
                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.title }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar v-if="authenticated" :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
                <span class="hidden-sm-and-down">Bank</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon @click="logout"><v-icon>mdi-logout</v-icon></v-btn>
        </v-app-bar>
        <v-main>
            <v-container class="fill-height" fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
        <notifications group="foo" />
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            drawer: null,
            items: [
                {icon: 'mdi-timetable', title:'Course', route:'/course'},
                {icon: 'mdi-history', title:'History', route:'/history'},
                {icon: 'mdi-sync', title:'Converter', route:'/converter'},
            ],
            authenticated: auth.check(),
            user: auth.user
        };
    },
    mounted() {
        Event.$on('userLoggedIn', () => {
            this.authenticated = auth.check();
            this.user = auth.user;
        });
    },

    methods: {
        logout(){
            auth.logout(this);
        }
    },
}
</script>
