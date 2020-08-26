<template>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Enquetes</h1>
            <ul class="list-group">
                <li class="list-group-item"><router-link to="/poll">Nova Enquete</router-link></li>
            </ul>
        </div>
        <div class="col-lg-12" v-if="polls.length  > 0">
            <h2>Enquetes Ativas</h2>

            <ul class="list-group" v-for="poll in polls" v-if="polls.length > 0">
                <li class="list-group-item">{{poll.description}}</li>
                <li class="list-group-item"><router-link :to="{ name: 'vote', params: { id: poll.id}}">Votar</router-link></li>
                <li class="list-group-item"><router-link :to="{ name: 'estado',params: {id: poll.id}}">Estado da enquete</router-link></li>
            </ul>


        </div>
    </div>
</div>
</template>

<script>
export default {
    name:"start",
    data() {
        return {
            polls: {}
        }
    },
    methods: {
        getPoll(){
            axios.get('/api/poll/')
                .then((response)=>{
                    this.polls = response.data.polls
                }).catch(function (error) {
                console.log(error);
            })
        }
    },
    created() {
        this.getPoll();
    }
}
</script>

<style scoped>

</style>
