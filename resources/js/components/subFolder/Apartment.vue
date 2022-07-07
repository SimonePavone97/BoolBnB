<template>
    <div class="">
        <p>{{ apartment.title }}</p>
    </div>
</template>

<script>
export default {
    name: 'Apartment',

    // emit per portare una funz da padre a figlio 
    // props per portare da figlio a padre
    props: {
        apartment: Array,
    },
    
    data() {
        return {
            
        }
    },
}
</script>

<style scoped lang="scss">

</style>