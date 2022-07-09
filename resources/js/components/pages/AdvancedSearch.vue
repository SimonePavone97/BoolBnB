<template>
    <div>
        ciaooooooooooooooo
        <div>
            <input type="text" v-model="searchText" @keyup.enter="getAddress" placeholder="Cerca una città coglione">
                <button @click="getAddress" type="submit"
                    class="btn btn-secondary mx-2">Cerca</button>
            
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AdvancedSearch',

    data() {
        return {
            isError: false,
            searchText: "",
            boh: [],
            position:[]
        }
    },

    methods: {
        getAddress(){
            axios.get(`https://api.tomtom.com/search/2/geocode/${this.searchText}.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3`)
                .then((res) => {
                    this.boh = res.data.results;
                    console.log(this.boh);
                    this.position.push(this.boh[0].position)
                    console.log(this.position)
                }).catch((err) => {
                   this.isError = true;
                });
        }, 
    },
    mounted() {
        this.getAddress();
        
    },
}



</script>

<style scoped>
</style>
