<template>
  <vs-textarea v-model="answer" label="답" />
</template>

<script>
export default {
    name: 'long-answer-view',
    data() {
        return {
            answer: '',
        };
    },
};
</script>

<style>

</style>
