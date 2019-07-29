<template>
    <div>
        <div class="row mt-3">
          <div class="d-flex flex-row">
            <div><h3 class="pname">{{ name }}</h3></div>
            <div v-if=" userId != profileId "><button class="btn btn-outline-warning follow" href="" style="font-weight: bold;" @click.prevent="followUser">{{ followOrUn }}</button></div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="d-flex flex-row">
            <div><h4 class="about">{{ recipes }} Recipes</h4></div>
            <div><h4 class="about">{{ followerCount }} Followers</h4></div>
            <div><h4 class="about">{{ following }} Following</h4></div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                followerCount:0,
                followOrUn: 'follow',
            }
        },
        
        props:[
            'name', 'profileId', 'userId', 'followers', 'following', 'followOrNot', 'recipes'
        ],

        created(){
            this.followerCount = this.followers;
            if (this.followOrNot <= 0) {
                this.followOrUn = 'Follow';
            }else{
                this.followOrUn = 'Unfollow';
            }
        },

        mounted(){
            console.log('Component mounted.')
        },

        methods:{
            followUser(){
                if(this.userId){
                    axios.post('/author/saveFollow/' + this.profileId, {
                        id: this.profileId
                    })
                        .then(response => {
                            if(response.data == 'deleted') {
                                this.followerCount--;
                                this.followOrUn = 'Follow';
                            }if(response.data == 'followed'){
                                this.followerCount++;
                                this.followOrUn = 'UnFollow';
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
