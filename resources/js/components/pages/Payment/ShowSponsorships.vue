<template>
    <div>
        <div class="container">
            <div class="" v-if="loading">Loading</div>
            <div v-else class="d-flex">
                <div v-for="sponsorship in sponsorships" :key="sponsorship.id">
                    <Sponsorship :sponsorship="sponsorship" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Sponsorship from './Sponsorship.vue'

export default {
    name: "ShowSponsorships",
    components: {
        Sponsorship
    },
    props: {
        propsSponsorship: Array,
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
                    console.log(res.data.data);
                    this.sponsorships = res.data.data;
                    this.loading = false;
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
