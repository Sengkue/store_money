<template>
    <div>
        <h1>this is tramsection page</h1>
    </div>
</template>

<script>
export default {
    name: 'MoneyTramsection',

    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },
     beforeRouteEnter(to, from, next){
			if(!window.Laravel.isloggedin_laravel){
				window.location.href = "/login";
			}
			next();
	}
};
</script>

<style lang="scss" scoped>

</style>