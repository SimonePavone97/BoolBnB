<template>
    <div>
        <div class="search-content">
            <div>
                <h1>Trova l'appartamento dei tuoi sogni</h1>
    
                <form class="form-inline d-flex justify-content-center" >
                    <input class="" type="text" v-model="searchText" @keydown.enter.prevent="$emit('searchFunction', searchText)" placeholder="Cerca una città...">
                    <button @click.prevent="$emit('searchFunction', searchText)" type="submit"
                        class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SearchComp',

    data() {
        return {
            searchText: "", 
        }
    },
}
</script>

<style scoped lang="scss">

    .search-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-image: url('../../../../images/hero.jpg');
        background-size: cover;
        background-position: 0% 80%;
        padding: 200px 0;
        margin-bottom: 50px;
        height: 80vh;
    }

    h1 {
        font-size: 50px;
        color: white;
        margin-bottom: 60px;
    }

    input, button {
        padding: 0 20px;
        height: 40px;
    }

    input {
        width: 500px;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    button {
        background-color: #ff385c;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    button i {
        font-size: 20px;
    }

    button {
        background-color: var;
    }
</style>