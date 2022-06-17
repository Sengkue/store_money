<template>
    <div>
    borrow page
    </div>
</template>

<script>
export default {
    name: 'StoreMoneyBorrow',

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