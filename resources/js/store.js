import Vue from 'vue'
import vuex from 'vuex'
Vue.use(vuex)



export default new vuex.Store({
    state : {
        counter : 1000
    },
    mutations: {
        changeCorrentValue(state, data){
            this.state.counter += data;
        }
    }
})
