<template>
    <div>
        <Header />
    </div>
</template>

<script>
import Header from '../../components/Header'

export default {
    name: 'HomePage',

    components: {
        Header,
    },

    methods: {
        queryFunDad(query) {
            axios.get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.id}`).then((res) => {
                console.log(res);
                this.saveApiArrayApartments = res.data.results;
            })
        },
    },

}

</script>

<style scoped>
</style>
