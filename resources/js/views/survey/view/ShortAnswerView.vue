<template>
  <vs-input v-model="answer" label="답" />
</template>

<script>
export default {
    name: 'short-answer-view',
    data() {
        return {
            answer: '',
        };
    },
};
</script>

<style>

</style>
