<template>
  <div
    id="suvray-create-selection"
    class="border border-solid border-gray-400 rounded relative overflow-hidden">
    <case-form-wizard title="OX형 설문조사 생성" subtitle="">
      <tab-content
        title="설문조사 기본 설정"
        :before-change="validate('step1')"
      >
        <form @submit="e => e.preventDefault()" data-vv-scope="step1">
          <div class="vx-row align-left">
            <div class="vx-col sm:w-1/2 w-full mb-2">
              <vs-input
                class="w-full"
                label="설문조사 제목"
                name="title"
                v-model="title"
                v-validate="'required'"
              />
            </div>
          </div>
        </form>
      </tab-content>
      <tab-content title="설문조사 최종 확인"> </tab-content>
    </case-form-wizard>
  </div>
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
                                    reject(new Error('설문조사 추가 실패'));
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

<style>

</style>
