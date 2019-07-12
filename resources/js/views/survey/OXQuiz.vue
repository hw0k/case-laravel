<template>
  <vs-col
    id="suvray-create-selection"
    class="relative overflow-hidden">
    <case-form-wizard title="OX형 설문조사 생성" subtitle="">
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
              <ul class="demo-alignment">
                <li>
                  <vs-radio v-model="answer" vs-value="O">O</vs-radio>
                </li>
                <li>
                 <vs-radio v-model="answer" vs-value="X">X</vs-radio>
                </li>
              </ul>

              <vs-button @click="AddImage" class="mt-6">이미지 추가</vs-button>
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
            </div>
          </div>
        </form>
      </tab-content>
      <tab-content title="퀴즈 최종 확인"> </tab-content>
    </case-form-wizard>
  </vs-col>
</template>

<script>
import FileUpload from 'vue-upload-component';
import CaseFormWizard from '@/components/form/CaseFormWizard.vue';

export default {
    data() {
        return {
            title: '',
            qu_idx: 0,
            answer: '',
            explain: '',
            images: [],
            isAdd: false,
            isSet: true,
            media: '',
        };
    },
    methods: {
        onComplate() {},
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
                            const formData = new FormData();
                            formData.append('media', this.media);
                            formData.append('question', this.title);
                            formData.append('answer', this.answer);
                            formData.append('table', 'example');
                            formData.append('type', 'ox');
                            this.$http.post('/case/addQuiz', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                },
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

                            this.$vs.loading.close();
                            resolve(true);
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
        FileUpload,
    },
};
</script>

<style scopped>
.align-left {
  text-align: left;
}
</style>
