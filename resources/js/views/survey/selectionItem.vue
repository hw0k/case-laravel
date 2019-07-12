<template>
  <div>
    <ul class="centerx">
      <li v-for="i in Count" :key="i">
        <vs-radio class="ml-4" v-model="select" vs-value=i>
          <vs-input
            class="w-full p-2"
            name=i
            v-model="selection[i]"
            v-validate="'required'"
          />
        </vs-radio>
      <span @click="handleDelete(i)">&times;</span>

      </li>
    </ul>
    <vs-button color="primary" class="ml-4" type="line" @click="addSelection()" v-if="Count<5">보기 추가</vs-button>
  </div>
</template>

<script>

export default {
    data() {
        return {
            title: '',
            isSet: true,
            images: [],
            select: '',
            selection: [],
            Count: 2,
            isAdd: false,
        };
    },
    methods: {
        addSelection() {
            if (this.Count < 5) {
                this.Count++;
            }
        },
        handleDelete(i) {
            this.selection.splice(i, 1);
            this.images.splice(i, 1);
            this.Count--;
        },
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
            formData.append('number', this.i);

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
        AddImage() {
            this.isAdd = true;
        },
    },

    name: 'selection-item',
    components: { },
    props: ['idx'],
};
</script>

<style>
</style>
