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
          <vs-button @click="AddImage" class="m-6">이미지 추가</vs-button>
          <div class=" w-full mb-2 vx-col" v-if="isAdd">
            <file-upload
              v-if="isSet"
              extensions="gif,jpg,jpeg,png,webp"
              v-model="images"
              @input-file="onAddFile"
              @input-filter="onFilterFile"
            >
              <img :src="images.length > 0 ? images[0].url : require('@/assets/images/default.jpg')" class="sm:w-2/3 w-full mb-2 mt-6"/>
            </file-upload>
            <img
              v-else
              :src="images.length > 0 ? images[0].url : require('@/assets/images/default.jpg')"
              class="sm:w-2/3 w-full mb-2 mt-6"
            />
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
import FileUpload from 'vue-upload-component';
import CaseFormWizard from '@/components/form/CaseFormWizard.vue';
import SelectionItem from './selectionItem.vue';

export default {
    data() {
        return {
            title: '',
            qu_idx: 0,
            explain: '',
            images: [],
            tags: [],
            isAdd: false,
            isSet: true,
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
        onAddFile(newFile) {
            this.media = newFile.file;
        },
        onFilterFile(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                if (!/\.(gif|jpg|jpeg|png|webp)$/i.test(newFile.name)) {
                    this.alert('이미지를 올려 주세요');
                    return prevent();
                }
            }
            if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
                newFile.url = '';
                const URL = window.URL || window.webkitURL;
                if (URL && URL.createObjectURL) {
                    newFile.url = URL.createObjectURL(newFile.file);
                }
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
                                type: 'example',
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
        AddImage() {
            this.isAdd = true;
        },
    },
    components: {
        CaseFormWizard,
        SelectionItem,
        FileUpload,
    },
};
</script>

<style scopped>
.align-left {
  text-align: left;
}
</style>
