<template>
<ul class="list-group">
    <li class="list-group-item" v-for="menu in menuItems">
        <a :href="menu.url">
            {{menu.nome}}
        </a>
    </li>                            
</ul>
</template>

<script>
    export default {
        data(){
            return {
                menuItems: []
            }
        },
        created(){
            var that = this; 
            axios.get('/processos').then( function(response){
                that.menuItems = response.data;
            } );
           
        },
        mounted() {
            console.log('Component mounted.')
        },
        

    }
</script>
