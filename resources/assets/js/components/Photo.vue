<template>
<div class="col-md-3 col-sm-3 picture_h">
<div class="panel panel-default">
    <div class="panel-heading">Detalhes da Foto</div>
    <div class="panel-body">
        <a href="#" class="thumbnail">
            <img :src="src" :alt="alt">
        </a>
    
        <form class="form-horizontal detalhes" :id="id" method="post" v-if="showForm()">
            <input type="hidden" name="_id" :value="id">
            <input type="hidden" id="method" name="_method" value="PUT">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>
                    Local
                    </label>
                        <input id="legenda" class="form-control input-sm col-md-7 col-xs-12" :value="legenda" type="text" name="legenda">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>
                        Data
                    </label>
                    <input id="data" class="form-control col-md-7 input-sm col-xs-12" :value="data" type="date" name="data">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <button class="btn btn-success btn-block btn-xs">Salvar</button>
                </div>
            </div>
        </form>
        <div class="caption" v-else>
            <p>
                <span class="glyphicon glyphicon-flag"></span>
                {{legenda}}
            </p>
            <p><span class="glyphicon glyphicon-time"></span>{{data | formatDate}}</p>
        </div>
        <a href="#" :data-id="id" class="btn btn-danger btn-block btn-xs deletar">Deletar</a>
    </div>
</div>
 </div>
</template>
<script>
    export default {
        data(){
            return {
                showForm: function(){
                    if(this.legenda == null || this.data == null ){
                        return true
                    }else{
                        return false;
                    }
                }
            }
        
        },
        mounted() {
            console.log( !this.showForm());
        },
        props: ['src', 'alt', 'legenda', 'data', 'id']
    }

</script>