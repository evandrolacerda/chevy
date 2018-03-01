<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
           aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-bell alertNotificacao"></span>
            <span class='badgeAlert' v-if="unreadMessages > 0">{{unreadMessages}}</span>
            <span class="caret"></span></a>
        <ul class="list-notificacao dropdown-menu">
            <li id='item_notification_1' v-for="notification in notifications">
                <div class="media">
                    <div class="media-body">
                        <div class='exclusaoNotificacao'>
                            <button class='btn btn-danger btn-xs button_exclusao' 
                                    id='1' @click='markAsRead(notification.id)'>x</button>
                        </div>
                        <h4 class="media-heading">Pontuação elevada</h4>
                        <p class="notification_text">
                            Sua Pontuação foi elevada em {{notification.data.pontos}} 
                            pontos por ter completado o proceso {{notification.data.processo}}.
                            <br>
                            <small class="pull-right">
                                {{notification.created_at | formatDate}}
                            </small>
                        </p>

                    </div>
                </div>
            </li>    

        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: [],

                unreadMessages: 0,
            }
        },
        created() {
            this.loadMessages();

            Echo.private('App.User.' + window.userId.content)
                    .notification((notification) => {
                        that.notifications.push(notification);
                    });

        },
        mounted() {
            console.log('Component mounted.');

        },
        methods: {

            loadMessages() {

                var that = this;
                axios.get('/notifications').then(function (response) {
                    that.notifications = response.data;

                    console.log('Chamando Mensagens');
                    that.unreadMessages = that.notifications.filter(function (element) {
                        return element.read_at === null;

                    }).length;
                });

            },

            count() {

                this.notifications.forEach(function (not) {
                    console.log(not.read_at);
                });

            },
            markAsRead(id) {
                var that = this;
                axios.put(`/notifications/${id}`, {
                    _method: 'PUT',
                    id: id
                }).then((response) => {
                    that.loadMessages();
                    console.log('Marcado como lida');
                }, (err) => {
                    console.table(err);
                });
            }

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
    .list-notificacao{
        height: 300px;
        overflow: auto;
        top: 31px;

    }
    .media-heading
    {
        color: #004400;
        font-weight: bold;
    }
    p.notification_text
    {
        font-weight: bold;
    }
    .head{
        position: fixed;
        width: 100%;
        z-index: 10;
    }
</style>
