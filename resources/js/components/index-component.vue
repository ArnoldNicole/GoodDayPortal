<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Hello {{user.name}} You are viewing info for class </div>

            <div class="card-body">
               {{classdata}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user:{
                    name:'Arnold Wamae'
                },
                clas:'8'
            }
        },
        props:{
            classdata: Object
        },

    }
</script>
