<template>
    <div>
        <button v-if="!liked" type="button" class="btn btn-outline-light" @click="like(eventId)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg>
        </button>
        <button v-else type="button" class="btn btn-outline-light" @click="unlike(eventId)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['eventId', 'userId', 'defaultLiked'],
        data(){
            return {
                liked: false,
        }},
        created (){
            this.liked = this.defaultLiked
        },
        
        methods: {
            like(eventId){
                let url = `/api/event/${eventId}/favorite`

                axios.post(url, {
                    user_id: this.userId})
                .then(response => {
                    this.liked = true
                })
                .catch(error => {
                    alert(error)
                })
            },
            unlike(eventId){
                let url = `/api/event/${eventId}/unfavorite`

                axios.post(url, {
                    user_id: this.userId})
                .then(response => {
                    this.liked = false
                })
                .catch(error => {
                    alert(error)
                })
            }


        }
    }
</script>