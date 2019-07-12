<template>
  <div>
    <case-card>
      <vs-row vs-w="12" vs-type="flex" vs-align="center" vs-justify="space-between">
        <vs-col vs-w="9" vs-type="flex" vs-justify="center" vs-align="center">
          <vs-input class="inputx flex-1 my-4" placeholder="설문지 제목" v-model="title" />
        </vs-col>
        <vs-col vs-w="3" vs-type="flex" vs-justify="center" vs-align="center">
          <vs-dropdown>
            <vs-button type="filled" class="flex-1 btnx hover:cursor-pointer">문항 추가</vs-button>
            <vs-dropdown-menu>
              <vs-dropdown-group vs-label="주관형" class="mt-0 outline-none border-0">
                <vs-dropdown-item @click="addQuestion('ShortAnswer')">
                  <span class="flex items-center">
                    <feather-icon class="icon-adjust mr-2" icon="Edit3Icon" />
                    <span>단답형</span>
                  </span>
                </vs-dropdown-item>
                <vs-dropdown-item @click="addQuestion('LongAnswer')">
                  <span class="flex items-center">
                    <feather-icon class="icon-adjust mr-2" icon="EditIcon" />
                    <span>장문형</span>
                  </span>
                </vs-dropdown-item>
              </vs-dropdown-group>
              <vs-dropdown-group vs-label="선다형">
                <vs-dropdown-item @click="addQuestion('OXQuiz')">
                  <span class="flex items-center">
                    <feather-icon class="icon-adjust mr-2" icon="SlashIcon" />
                    <span>OX형</span>
                  </span>
                </vs-dropdown-item>
                <vs-dropdown-item @click="addQuestion('Selection')">
                  <span class="flex items-center">
                    <feather-icon class="icon-adjust mr-2" icon="CheckIcon" />
                    <span>선택형</span>
                  </span>
                </vs-dropdown-item>
                <vs-dropdown-item @click="addQuestion('Tournament')">
                  <span class="flex items-center">
                    <feather-icon class="icon-adjust mr-2" icon="TrendingUpIcon" />
                    <span>토너먼트형</span>
                  </span>
                </vs-dropdown-item>
              </vs-dropdown-group>
            </vs-dropdown-menu>
          </vs-dropdown>
        </vs-col>
      </vs-row>
    </case-card>
    <template v-for="(question, index) in questions">
      <case-card :key="index" class="mt-8">
        <vs-row>
          <component :is="question.type" />
        </vs-row>
      </case-card>
    </template>
    <case-card class="mt-8">
      <vs-row class="mt-3">
        <vs-col>
          <vs-input
            class="mb-2 w-32"
            label="태그 추가"
            @keypress="handleTagInput"
            v-model="tagInfo"
          />
          <vs-chip
            color="primary"
            @click="removeTag(index)"
            v-for="(tag, index) in tags"
            :key="index"
            closable
            >{{ tag }}</vs-chip
          >
        </vs-col>
      </vs-row>
      <vs-row class="mt-3">
        <vs-col>
          <label for class="vs-input--label">크레딧</label>
          <vs-input-number
            class="mb-2 w-24"
            v-model="credit"
            :step="50"
          />
        </vs-col>
      </vs-row>
      <vs-row vs-w="12" vs-type="flex" class="mb-4">
        <vs-col vs-type="flex" vs-w="3" vs-offset="9" vs-justify="center" vs-align="center">
          <vs-button type="filled" color="success" class="btnx hover:cursor-pointer">설문 등록</vs-button>
        </vs-col>
      </vs-row>
    </case-card>
  </div>
</template>

<script>
import Tournament from './tournament.vue';
import Selection from './selection.vue';
import ShortAnswer from './ShortAnswer.vue';
import LongAnswer from './LongAnswer.vue';
import OXQuiz from './OXQuiz.vue';

export default {
    name: 'make-survey',
    components: {
        Tournament, ShortAnswer, LongAnswer, Selection, OXQuiz,
    },
    data() {
        return {
            title: '',
            loading: false,
            questions: [],
            tagInfo: '',
            tags: [],
            credit: 0,
        };
    },
    methods: {
        addQuestion(type) {
            this.questions.push({
                type,
            });

            let typeText = '';
            if (type === 'Tournament') {
                typeText = '토너먼트형';
            }
            if (type === 'ShortAnswer') {
                typeText = '단답형';
            }
            if (type === 'LongAnswer') {
                typeText = '장문형';
            }
            if (type === 'Selection') {
                typeText = '선택형';
            }
            if (type === 'OXQuiz') {
                typeText = 'OX형';
            }

            this.$vs.notify({
                title: '문항 추가 완료',
                text: `${typeText} 문항이 추가되었습니다. 아래를 확인하세요.`,
                color: 'success',
            });
        },
        handleTagInput(e) {
            if (e.keyCode === 13 && this.tagInfo.length > 0) {
                this.tags.push(this.tagInfo);
                this.tagInfo = '';
                e.preventDefault();
            }
        },
        removeTag(idx) {
            this.tags.splice(idx, 1);
        },
    },
};
</script>

<style lang="scss" scoped>
.icon-adjust {
  height: 1em;
  width: 1em;
  padding-top: 0.1rem;
}
</style>
