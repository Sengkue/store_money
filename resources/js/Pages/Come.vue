<template>
    <div>
        <time-ago refresh long locale="en" :datetime="new Date()">
    <template v-slot="{ timeago }">
      <span class="text-gray-600 text-sm">
        {{ timeago }}
      </span>
    </template>
  </time-ago>
    </div>
</template>

<script>
export default {
    name: 'MoneyCome',

    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>

</style>