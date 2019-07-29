<template>
    <div class="col-5 d-flex flex-row frate" @click.prevent="likeRecipe"><i class="material-icons">{{ likeOrUn }}</i><span class="love"><p>{{ likeCount }}</p></span></div>
</template>

<script>
    export default {

        data(){
            return {
                likeCount:0,
                likeOrUn:'favorite_border',
            }
        },
        
        props:[
            'recipeId', 'userId', 'like', 'likeCheck'
        ],

        created(){
            this.likeCount = this.like;
            if (this.likeCheck <= 0) {
                this.likeOrUn = 'favorite_border';
            }else{
                this.likeOrUn = 'favorite';
            }
        },

        mounted(){
            console.log('Component mounted.')
        },

        methods:{
            likeRecipe(){
                if(this.userId){
                    axios.post('/author/saveLike/' + this.recipeId, {
                        id: this.recipeId
                    })
                        .then(response => {
                            if(response.data == 'deleted') {
                                this.likeCount--;
                                this.likeOrUn = 'favorite_border';
                            }if(response.data == 'liked'){
                                this.likeCount++;
                                this.likeOrUn = 'favorite';
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
