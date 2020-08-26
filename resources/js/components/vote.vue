<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Enquete</h3>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Voltar</button></div>
                    <div class="card-body">
                        {{poll.description}}
                        <form @submit.prevent="votePoll()">
                        <div class="custom-checkbox" v-for="option in poll.options" >
                            <input type="radio" v-model="chosen" v-bind:value="option.id" > {{option.option_description}}
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" >Votar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
s
<script>
    export default {
        data() {
            return {
                poll: {},
                chosen: {},
                status:{}
            }
        },
        methods: {
            getPoll(){
                axios.get('/api/poll/'+ this.$route.params.id )
                    .then((response)=>{
                        this.poll = response.data.poll
                    }).catch(function (error) {
                        console.log(error);
                })
            },
           votePoll(){
                axios.put('/api/poll/'+ this.chosen )
                    .then((response)=>{
                        this.$router.push("/poll/"+this.poll.id+"/stats");
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
