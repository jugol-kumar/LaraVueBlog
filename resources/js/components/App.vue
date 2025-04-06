<template>
    <div>
        <!--========== ADMIN SIDE MENU one ========-->
        <div class="_1side_menu" v-if="this.$store.state.showView">
            <div class="_1side_menu_logo">
                <h3 style="text-align:center;">Logo Image</h3>
                <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
            </div>
            <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
            <div class="_1side_menu_content">
                <div class="_1side_menu_img_name">
                    <!-- <img class="_1side_menu_img" src="/pic.png" alt="" title=""> -->
                    <p class="_1side_menu_name">Admin</p>
                </div>

                <!--~~~ MENU LIST ~~~~~~-->
                <div class="_1side_menu_list">
                    <ul class="_1side_menu_list_ul">
                        <li><router-link to="/"><Icon type="md-person" />Airlines</router-link></li>
                        <li><a @click="logout"><Icon type="md-power" />Logout</a></li>
                    </ul>
        <div v-if="isLogin">
            <!--========== ADMIN SIDE MENU one ========-->
            <div class="_1side_menu" >
                <div class="_1side_menu_logo">
                    <h3 style="text-align:center;">Logo Image</h3>
                    <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
                </div>

                <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
                <div class="_1side_menu_content">
                    <div class="_1side_menu_img_name">
                        <!-- <img class="_1side_menu_img" src="/pic.png" alt="" title=""> -->
                        <p class="_1side_menu_name">Admin</p>
                    </div>

                    <!--~~~ MENU LIST ~~~~~~-->
                    <div class="_1side_menu_list">
                        <ul class="_1side_menu_list_ul">
                            <!--                        <li v-for="(menuItem, i) in permission" :key="i" v-if="permission.length && menuItem.read">-->
                            <!--                            <router-link><Icon type="ios-speedometer" /> some name</router-link>-->
                            <!--                        </li>-->


                            <li><router-link to="/"><Icon type="ios-speedometer" /> Dashboard</router-link></li>

                            <li><router-link to="tags"><Icon type="md-pricetags"/> Tags</router-link></li>
                            <li><router-link to="categories"><Icon type="ios-podium" /> Category</router-link></li>
                            <li><router-link to="post"><Icon type="md-list-box" /> Post </router-link></li>
                            <li><router-link to="user"><Icon type="ios-checkmark-circle" /> User </router-link></li>
                            <!--                        <li><router-link to="adminusers"><Icon type="ios-speedometer" /> Admin users</router-link></li>-->
                            <!--                        <li><router-link to="role"><Icon type="ios-speedometer" /> Role Management</router-link></li>-->
                            <!--                        <li><router-link to="assignRole"><Icon type="ios-speedometer" /> Assign role</router-link></li>-->


                            <li><a href="/logout"><Icon type="md-power" />Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--========== ADMIN SIDE MENU ========-->
        <!--========= HEADER ==========-->
        <div class="header" v-if="this.$store.state.showView">
            <div class="_2menu _box_shadow">
                <div class="_2menu_logo">
                    <ul class="open_button">
                        <li>
                            <Icon type="ios-list" />
                        </li>
                    </ul>
            <!--========= HEADER ==========-->
            <div class="header">
                <div class="_2menu _box_shadow">
                    <div class="_2menu_logo">
                        <ul class="open_button">
                            <li>
                                <Icon type="ios-list" />
                            </li>
                            <!--<li><Icon type="ios-albums" /></li>-->
                        </ul>
                    </div>
                </div>
            </div>

            <!--========= HEADER ==========-->
        </div>
        <router-view/>
    </div>
        </div>
        </div>

</template>


<script>
import Header from "./persial/Header";
import SideBar from "./persial/SideBar";
import Footer from "./persial/Footer";
export default {
    components: {
        Header,
        SideBar,
        Footer,
    },
    show: false,
    name: "App",
    created() {
        if (this.$store.state.token) {
            this.$store.commit("showSideTop", true);
            this.$router.push("/");
        } else {
            this.show = false;
            this.$store.commit("showSideTop", false);
            this.$router.push("/login")
        }
    },
    methods: {
        logout() {
            axios.post("api/logout", {token: this.$store.state.token})
                .then(res => {
                    this.$store.commit("clearToken");
                    this.$store.commit("showSideTop", false);
                    this.$router.push("/login")
                })
                .catch(err => {
                    this.$store.commit("clearToken");
                    this.$store.commit("showSideTop", false);
                    this.$router.push("/login")
                })
        },
        name: "App",
        data() {
            return {
                isLogin: false,
            }
        },
        created() {
            let route = this.$router.params
            console.log(route);
        }
    }
}
</script>

<style scoped>

</style>
