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
            boh: []
        }
    },

    methods: {
        getAddress(){
            axios.get(`https://api.tomtom.com/search/2/geocode/${this.searchText}.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3`)
                .then((res) => {
                    console.log(res)
                    this.boh = res;
                    console.log(this.boh);
                }).catch((err) => {
                   this.isError = true;
                });
                // $response = Http::get($APIrequest)->json();
                // $apartment->longitude = $response['results'][0]['position']['lon'];
                // $apartment->latitude = $response['results'][0]['position']['lat'];

                // var request = new XMLHttpRequest();
                // request.open('GET', this.requestUrl);
                // request.responseType = 'json';
                // request.send();
                // console.log(request);
        }, 
    },
    mounted() {
        this.getAddress();
        
    },
}



</script>

<style scoped>
</style>
