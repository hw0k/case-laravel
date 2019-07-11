<template>
  <vs-card>
    <div slot="header">
      <h3 v-if="!isSet">{{ title }}</h3>
      <vs-input
        class="w-full"
        v-else
        label-placeholder="이름"
        v-model="title"
      />
    </div>
    <div slot="media">
      <file-upload
        v-if="isSet"
        extensions="gif,jpg,jpeg,png,webp"
        v-model="images"
        @input-file="onAddFile"
        @input-filter="onFilterFile"
      >
        <img
          :src="
            images.length > 0
              ? images[0].url
              : require('@/assets/images/default.jpg')
          "
        />
      </file-upload>
      <img
        v-else
        :src="
          images.length > 0
            ? images[0].url
            : require('@/assets/images/default.jpg')
        "
      />
    </div>
  </vs-card>
</template>

<script>
import FileUpload from 'vue-upload-component/dist/vue-upload-component.part';

export default {
    data() {
        return {
            title: '제목',
            images: [],
            isSet: true,
        };
    },
    methods: {
        onAddFile(newFile, oldFile, prevent) {
            if (this.title.length < 1) {
                this.alert('제목을 작성하고 이미지를 업로드 해주세요');
                prevent();
            }
            console.log(this.images);
            console.log(newFile, oldFile, prevent);
            const formData = new FormData();
            formData.append('media', newFile.file);
            formData.append('quiz', this.idx);
            formData.append('explain', this.title);

            this.$http.post('/case/addColumn', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            }).then(({ data }) => {
                if (data) {
                    this.isSet = false;
                }
            }).catch((err) => {
                console.log(err);
                this.alert('저장 오류');
            });
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
    },
    name: 'tournament-item',
    components: { FileUpload },
    props: ['idx'],
};
</script>

<style>
</style>
