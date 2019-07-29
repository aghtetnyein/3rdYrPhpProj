<template>
	
	<div class="row mb-3">
        <div class="col-lg-12">
            <div class="border row bg-white eachblog">
                <div class="col-lg-6 col-sm-12 col-ls-12 image">
                    <img src="" alt="image" class="fimage">
                </div>
                <div class="col-lg-6 col-sm-12 col-ls-12">
                    <div class="row" id="save">
                        <div class="col-10 d-flex flex-row">
                            <a href="#"> 
                                <img src="" alt="Avatar" class="profileimg">
                            </a>
                            <a href="#" class="profilename">{{ userName }}</a>
                        </div>
                        
                        <!-- <div class="col-2 save" @click.prevent="saveRecipe"><i class="material-icons">{{ saveOrUn }}</i></div> -->
                    </div>

                    <div class="row">
                        <h2 class="fname" style="text-align: left;">{{ title }}</h2>
                    </div>

                    <div class="row">
                        <p class="fmethod">Lightly oil the grill grate...</p>
                    </div>

                    <div class="row">
                        <div class="d-flex flex-row col-12 fperiod"><i class="material-icons">access_time</i><p class="pl-2">15 m</p></div>
                    </div>

                    <div class="row" id="like">
                        <div class="col-5 d-flex flex-row frate" @click.prevent="likeRecipe"><i class="material-icons">{{ likeOrUn }}</i><p class="love">{{ likeCount }}</p></div>

                        <div class="col-6 coverage"><a :href="'/author/recipe/' + recipeId" class="d-flex flex-row"><i class="material-icons">remove_red_eye</i><span>View</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {

    	data(){
            return {
                likeCount:0,
                likeOrUn:'favorite_border',
                //saveOrUn:'bookmark_border',
            }
        },

        props:[
            'recipeId', 'userId', 'userName', 'title', 'like',
        ],

        created(){
            this.likeCount = this.like;

            // if (this.likeCount > 0) {
            //     this.likeOrUn = 'favorite';
            // }else{
            //     this.likeOrUn = 'favorite_border';
            // }
        },

        mounted(){
            console.log('Component mounted.');
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
                                //this.likeOrUn = 'favorite_border';
                            }if(response.data == 'liked'){
                                this.likeCount++;
                                //this.likeOrUn = 'favorite';
                            }
                            console.log(response);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }else {
                    window.location = 'login'
                }
            },

            // saveRecipe(){
            //     if(this.userId){
            //         axios.post('/author/save/' + this.recipeId, {
            //             id: this.recipeId
            //         })
            //             .then(response => {
            //                 if(response.data == 'deleted') {
            //                     this.saveCount--;
            //                     this.saveOrUn = 'bookmark_border';
            //                 }if(response.data == 'saved'){
            //                     this.saveCount++;
            //                     this.saveOrUn = 'bookmark';
            //                 }
            //                 console.log(response);
            //             })
            //             .catch(error => {
            //                 console.log(error);
            //             });
            //     }else {
            //         window.location = 'login'
            //     }
            // },
        },

    }
</script>