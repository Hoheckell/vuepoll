<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       <h3> Nova da Enquete</h3> <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Voltar</button>
                            <div class="alert alert-success mt-3" v-if="this.enviado > 0">
                                Enquete cadastrada!
                            </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="newPoll()">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                    <input id="description" type="text" v-model="poll.poll_description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="opcao1">Opção 1</label>
                                <input id="opcao1" type="text" required v-model="poll.options[0]" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="opcao2">Opção 2</label>
                                <input id="opcao2" type="text" required v-model="poll.options[1]" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="opcao3">Opção 3</label>
                                <input id="opcao3" type="text" required v-model="poll.options[2]" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Criar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            "poll": {
                poll_description: '',
                options:[]
            },
            enviado:0
        }
    },
    methods: {
        newPoll(){
            axios.post('/api/poll',{
                poll:this.poll,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }).then((response)=>{
                if(response.status === 200){
                    this.enviado = 1
                }
                console.log(response.data.poll.id);
                }).catch(function (error) {
                console.log(error);
            })
        }
    },
    created() {
    }
}
</script>
