<template>
    <div>

        <div class="container">
            <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20 col-md-4">
                <div class="login_header">
                    <h1>Login Here</h1>
                </div>
                <div class="login_body">
                    <div class="space">
                        <Input type="email" v-model="data.email" placeholder="Email example@mail.com" />
                    </div>
                    <div class="space">
                        <Input type="password" v-model="data.password" placeholder="Enter a valid password" />
                    </div>
                </div>
                <div class="login_footer">
                    <Button type="info" @click="login">Login</Button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Login.vue",
    data(){
        return{
            data: {
                email:'',
                password:'',
            },
            isLogined:'',
        }
    },
    methods: {
       async login(){
            if (this.data.email.trim() == "") return this.e('Email address is Required','Opps')
            if (this.data.password.trim() == "") return this.e('Password is Required','Opps')

           await this.callApi('post', 'auth/login', this.data).then(res =>{
               if (res.status === 200){
                   this.s(res.data.msg, 'Logined');
                   this.data.email=''
                   this.data.password=''
               }else{
                   this.e(res.data.message, 'Error');
               }
           })
           .catch(err => {
               this.swr(err.response.data.message)
           })
       }
    }
}
</script>

<style scoped>
    ._1adminOverveiw_table_recent {
        margin: 230px auto;
    }
</style>
