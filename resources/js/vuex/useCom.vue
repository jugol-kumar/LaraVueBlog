<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <h1>Hey Im main component. Im Use THis All Other Component. </h1>
                <h2>This is form vuex stats {{$store.state.counter}}</h2>
                <comA></comA>
                <comB></comB>
                <comC></comC>

                <Button type="info" @click="changeCounter()">Change the stat value</Button>
            </div>
        </div>
    </div>
</template>

<script>
import comA from "./comA";
import comB from "./comB";
import comC from "./comC";
export default {
    mounted() {
        console.log('এই রান হচ্ছে রে। ')
    },
    components: {
        comA,
        comB,
        comC
    },
    methods: {
        changeCounter(){
            this.$store.commit('changeCorrentValue', 1);
        }
    }

}
</script>

<style scoped>

</style>
