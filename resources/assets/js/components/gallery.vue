<template>
        <div class="row">
            <photo v-for="photo in this.photos" :key="photo.id" 
        :src="photo.thumbs_path" :alt="photo.id" :legenda="photo.legenda" 
        :id="photo.id"
        :data="photo.data"></photo>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                photos : []
            }
        },
        methods:{
            load :function()
            {
                var that = this;
                axios.get('/album')
                    .then(function(response){
                        that.photos = response.data;
                        //console.log(response.data);
                });
            }
        },
        mounted: function() {
            
            this.load();
            var that = this;
            
            bus.$on('reload', function(){
                that.load()
            });


              
        }
    }
</script>

