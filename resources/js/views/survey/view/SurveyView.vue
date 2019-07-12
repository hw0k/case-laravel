<template>
  <div class="container mx-auto">
    <case-card>
      <span class="text-4xl">고객 만족도 설문조사</span>
      <div class="mt-12"></div>
      <div v-for="(question, index) in questions" :key="index" class="my-12">
        <span class="text-2xl">{{ question.title }}</span>
        <component :is="`${question.type}View`" class="mt-4" />
      </div>
      <vs-row vs-w="12" vs-type="flex" class="mt-4">
        <vs-col vs-type="flex" vs-w="2" vs-offset="10" vs-justify="flex-end" vs-align="center">
          <vs-button class="btnx">제출</vs-button>
        </vs-col>
      </vs-row>
    </case-card>
  </div>
</template>

<script>
import OXView from './OXView.vue';
import SelectionView from './SelectionView.vue';
import ShortAnswerView from './ShortAnswerView.vue';
import LongAnswerView from './LongAnswerView.vue';

export default {
    name: 'survey-view',
    components: {
        OXView, SelectionView, ShortAnswerView, LongAnswerView,
    },
    data() {
        return {
            questions: [
                {
                    type: 'ShortAnswer',
                    title: '당신은 누구십니까?',
                },
                {
                    type: 'LongAnswer',
                    title: '당신을 200자 이내로 표현해주세요!',
                },
                {
                    type: 'OX',
                    title: '당신은 아이폰 유저입니까?',
                },
                {
                    type: 'Selection',
                    title: '당신은 애플 기기를 몇 개 가지고 있습니까?',
                },
            ],
        };
    },
};
</script>

<style lang="scss">

</style>
