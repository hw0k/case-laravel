<template>
  <vs-col
    id="suvray-create-selection"
    class="relative overflow-hidden"
  >
    <case-form-wizard title="선택형 퀴즈 생성" subtitle="">
      <tab-content
        title="퀴즈 기본 설정"
        :before-change="validate('step1')"
      >
        <form @submit="e => e.preventDefault()" data-vv-scope="step1">
          <div class="vx-row align-left">
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <vs-input
                class="w-full"
                label="퀴즈 제목"
                name="title"
                v-model="title"
                v-validate="'required'"
              />
            </div>
          </div>
          <div class="vx-row align-left">
            <div class="vx-col w-full mb-2">
              <label for class="vs-input--label">태그</label>
              <div class="vs-con-input">
                <vs-input
                  size="small"
                  class="mb-2 w-24"
                  label-placeholder="태그 추가"
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
              </div>
            </div>
          </div>
        </form>
      </tab-content>

      <tab-content title="퀴즈 항목 생성">
        <div class="vx-row align-left">
          <selection-item :idx="qu_idx" />
        </div>
      </tab-content>

      <tab-content title="퀴즈 최종 확인"> </tab-content>
    </case-form-wizard>
  </vs-col>
</template>

<script>
import CaseFormWizard from '@/components/form/CaseFormWizard.vue';
import SelectionItem from './selectionItem.vue';

export default {
    data() {
        return {
            title: '',
            tourCount: [4, 8, 16, 32, 64],
            selectCount: 4,
            tags: ['computer', 'test', 'test2'],
            tagInfo: '',
            qu_idx: 0,
        };
    },
    methods: {
        onComplate() {},
        removeTag(idx) {
            this.tags.splice(idx, 1);
        },
        handleTagInput(e) {
            if (e.keyCode === 13 && this.tagInfo.length > 0) {
                this.tags.push(this.tagInfo);
                this.tagInfo = '';
                e.preventDefault();
            }
        },
        validate(step) {
            return () => new Promise((resolve, reject) => {
                this.$vs.loading();

                this.$validator.validateAll(step).then((result) => {
                    if (result) {
                        if (step === 'step1') {
                            this.$http.post('/case/addQuiz', {
                                question: this.title,
                                table: 'example',
                                type: 'tournament',
                            })
                                .then(({ data }) => {
                                    this.qu_idx = data.idx;
                                    this.$vs.loading.close();
                                    resolve(true);
                                })
                                .catch((e) => {
                                    console.error(e);
                                    this.$vs.loading.close();
                                    reject(new Error('퀴즈 추가 실패'));
                                });
                        } else {
                            this.$vs.loading.close();
                        }
                    } else {
                        reject(new Error('correct all value'));
                        this.$vs.loading.close();
                    }
                });
            });
        },
    },
    components: {
        CaseFormWizard,
        SelectionItem,
    },
};
</script>

<style scopped>
.align-left {
  text-align: left;
}
</style>
