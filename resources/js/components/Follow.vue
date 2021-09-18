<template>
    <div>
        
        <button v-if="!followed" type="button" class="btn btn-outline-dark" @click="follow(profileId)">Follow</button>
        <button v-else type="button" class="btn btn-dark" @click="unfollow(profileId)">Unfollow</button>
    </div>
</template>

<script>
    export default {
        props: ['profileId', 'userId', 'following'],
        data(){
            return {
                followed: false
            }
        },
        created(){
            this.followed = this.following
        },
        methods: {
            follow(profileId){
                let url = `/api/profile/${profileId}/follow`

                axios.post(url, {
                    user_id: this.userId})
                .then(response => {
                    this.followed = true
                })
                .catch(error => {
                    alert(error)
                })
            },
            unfollow(profileId){
                let url = `/api/profile/${profileId}/unfollow`

                axios.post(url, {
                    user_id: this.userId})
                .then(response => {
                    this.followed = false
                })
                .catch(error => {
                    alert(error)
                })
            }


        }
    }
</script>