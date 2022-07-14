<template>

        <div class="container">
            <div class="container my-4">
                <h2 class="text-center py-3">Invia un messaggio</h2>
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="sender">Sender</label>
                <input type="text" class="form-control" id="sender" name="sender" placeholder="Inserisci il tuo nome" required>
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
                
            </div>

            <div class="form-group col-12">
                <label for="text">Messaggio:</label>
                <textarea class="form-control" name="text" id="text" rows="3" placeholder="Inserisci qua il tuo messaggio" required></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Invia messaggio</button>
            </div>
        </div>

</template>

<script>



export default {
    name: 'MessagesSend',
    data() {
        return {
            
        }
    },

}

</script>

<style lang="scss" scoped>


</style>
