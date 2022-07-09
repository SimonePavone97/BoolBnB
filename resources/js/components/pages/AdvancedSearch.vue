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
            requesturl: `'https://api.tomtom.com/search/2/geocode/' . ${this.searchText} . '.json?key=cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9'`,
            searchText: "",
        }
    },

    methods: {
        getAddress(){
            axios.get(this.requesturl)
                .then((res) => {
                    console.log(res.data);
                    this.apartment = res.data;
                }).catch((err) => {
                    console.log(err);
                   this.isError = true;
                });
                // $response = Http::get($APIrequest)->json();
                // $apartment->longitude = $response['results'][0]['position']['lon'];
                // $apartment->latitude = $response['results'][0]['position']['lat'];

                var request = new XMLHttpRequest();
                request.open('GET', this.requestUrl);
                request.responseType = 'json';
                request.send();
                console.log(request);
        }, 
    },
    mounted() {
        this.getAddress();
        console.log();
    },
}



</script>

<style scoped>
</style>
