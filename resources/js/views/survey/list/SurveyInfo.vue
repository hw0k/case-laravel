<template>
  <vs-prompt
    vs-title="설문조사 상세보기"
    vs-accept-text="참가"
    vs-button-cancel="border"
    @vs-accept="joinSurvey"
    @vs-close="closeView"
    :vs-active.sync="isActive"
  >
  </vs-prompt>
</template>

<script>
export default {
    methods: {
        joinSurvey() {

        },
        closeView() {

        },
    },
    props: ['isActive'],
};
</script>

<style>
</style>
