<template>
    <div class="col-2 frate" @click.prevent="saveRecipe"><i class="material-icons">{{ saveOrUn }}</i></div>
</template>

<script>
    export default {

        data(){
            return {
                saveOrUn:'bookmark_border',
            }
        },
        
        props:[
            'recipeId', 'userId', 'saveCheck'
        ],

        created(){
            if (this.saveCheck <= 0) {
                this.saveOrUn = 'bookmark_border';
            }else{
                this.saveOrUn = 'bookmark';
            }
        },

        mounted(){
            console.log('Component mounted.')
        },

        methods:{
            saveRecipe(){
                if(this.userId){
                    axios.post('/author/save/' + this.recipeId, {
                        id: this.recipeId
                    })
                        .then(response => {
                            if(response.data == 'deleted') {
                                this.saveCount--;
                                this.saveOrUn = 'bookmark_border';
                            }if(response.data == 'saved'){
                                this.saveCount++;
                                this.saveOrUn = 'bookmark';
                            }
                            console.log(response);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }else {
                    window.location = 'login'
                }
            }
        },

    }
</script>
