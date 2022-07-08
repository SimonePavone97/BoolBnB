<template>
    <div>
        <div class="container">
            <div class="" v-if="loading">Loading {{sponsorships}}</div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "ShowSponsorships",
    components: {

    },
    data(){
        return {
            loading: true,
            sponsorships : []
        }

    },
    methods: {
        getSponsorships(){
            axios.get('http://localhost:8000/api/sponsorships')
                .then((res) => {
                    console.log(res.data);
                    this.sponsorships = res.data;
                });
        }
    },
    mounted (){
        this.loading = true;
        this.getSponsorships();
        
    }
}
</script>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

li {
    list-style-type: none;
}

a {
    text-decoration: none;
}
</style>
