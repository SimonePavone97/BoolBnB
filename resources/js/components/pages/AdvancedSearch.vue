<template>
    <div>
        ciaooooooooooooooo
        <div>
            <input type="text" v-model="searchText" @keyup.enter="getAddress" placeholder="Cerca una città">
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
            poilist:[],
            position:[],
            results:[]
            
        }
    },

    methods: {
        getPoilist(){
            axios.get("http://127.0.0.1:8000/api/positions")
                .then((res) => {
                    this.poilist = res.data;
                    console.log("POILIST",this.poilist);
                }).catch((err) => {
                   this.isError = true;
                });
        },
        getAddress(){
            axios.get(`https://api.tomtom.com/search/2/geocode/${this.searchText}.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3`)
                .then((res) => {
                    this.boh = res.data.results;
                    // console.log(this.boh);
                    this.position.push(this.boh[0].position)
                    console.log("POSITION",this.position)
                    console.log("LAT",this.position[0].lat);
                    console.log("LON",this.position[0].lon);
                }).catch((err) => {
                   this.isError = true;
                });
            axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3&geometryList=[{"type":"CIRCLE","position":"41.99577,14.99053","radius":20000}]&poiList=`+ JSON.stringify(this.poilist))
                .then((res) => {
                    this.results = res.data;
                    console.log("RISULTATI",this.results);
                    console.log(this.searchText);
                })
                .catch((error) => {
                    if (error.response) {
                    // Request made and server responded
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    } else if (error.request) {
                    // The request was made but no response was received
                    console.log(error.request);
                    } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
    }})
        }, 
        
    },
    mounted() {
        this.getPoilist(); 
        
   
    },
}



</script>

<style scoped>
</style>
