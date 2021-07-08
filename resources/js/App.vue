<template>
    <main class="container">

        <Header />
        <!-- questo è un tag Vue che riceve tutti i componenti iniettati dal ROUTER -->
        <router-view></router-view>

    </main>

</template>

<script>

import Header from './components/Header.vue';

export default {
    name: 'App',
    components:{
        Header
    },
    data(){
        return{

        }
    },
    methods:{

    },
    created(){

    }
}
</script>

<style lang="scss">
    @import '../sass/frontoffice/_global'
</style>
