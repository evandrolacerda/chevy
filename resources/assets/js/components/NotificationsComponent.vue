<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-bell alertNotificacao"></span>
            <span class='badgeAlert'>2</span>
            <span class="caret"></span></a>
        <ul class="list-notificacao dropdown-menu">
            <li id='item_notification_1'v-for="notification in notifications">
                <div class="media">
                    <div class="media-left"> 
                        <a href="#"> 
                            <img alt="64x64" class="media-object" data-src="holder.js/64x64" 
                    src="https://cdn4.iconfinder.com/data/icons/trophy-and-awards-1/64/Icon_Medal_Trophy_Awards_Blue-256.png" data-holder-rendered="true"> </a> 
                    </div>
                                                <div class="media-body">
                                                    <div class='exclusaoNotificacao'>
                                                        <button class='btn btn-danger btn-xs button_exclusao' id='1' onclick='excluirItemNotificacao(this)'>x</button>
                                                    </div>
                                                    <h4 class="media-heading">Pontuação elevada</h4>
                                                    <p>Sua Pontuação foi elevada em {{notification.data.pontos}} pontos por ter completado o proceso {{notification.data.processo}}</p>
                                                    <small>{{notification.created_at}}</small>
                                                </div>
                                            </div>
                                        </li>    
                                        
                                    </ul>
    </li>
</template>

<script>
    export default {
        data(){
            return {
                notifications: [],
                
                unreadMessages: 0,
            }
        },
        created(){
            var that = this;
            axios.get('/notifications').then( function(response){
                that.notifications = response.data;
                that.unreadMessages++;
            } );

           
           Echo.private('App.User.' + window.userId.content)
                .notification((notification) => {
                that.notifications.push(notification);
           });
           
        },
        mounted() {
            console.log('Component mounted.')
        }
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
