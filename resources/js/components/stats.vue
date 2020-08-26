<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Estado da Enquete</h3>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Voltar</button></div>
                    <div class="card-body">
                        {{poll.description}}
                            <ul class="list-group" v-for="option in poll.options" >
                                <li class="list-group-item" > {{option.option_description}} - {{option.votes}} Voto(s)</li>
                            </ul>
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
            poll: {}
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
        }
    },
    created() {
        this.getPoll();
    }
}
</script>
