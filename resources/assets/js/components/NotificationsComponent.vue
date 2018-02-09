<template>
<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-bell bell_b"></span>
                    <span class="badge badge-notify">2</span>
              </a>
              <ul class="dropdown-menu">
                <li v-for="notification in notifications">
                    <a href="#">
                        Você ganhou {{notification.pontos}} pelo processo {{notifications.processo_id}}
                    </a>
                </li>
              </ul>
</li>     
</template>

<script>
    export default {
        data(){
            return {
                notifications: []
            }
        },
        created(){
            //axios.get('/notifications').then( function(response){
            //    this.notifications = response.data;
            //} );
           var that = this;
           window.Echo.private(`App.User.${window.userId.content}`).listen('ScoreEvent', function(data){
                that.notifications.push(data.processo);

           });
        },
        mounted() {
            console.log('Component mounted.')
        },
        

    }
</script>
<style>
.badge-notify{
   background:red;
   position:relative;
   top: -16.5px;
   left: -10px;
  }
.bell_b{
    font-size: 20px;
}
</style>
