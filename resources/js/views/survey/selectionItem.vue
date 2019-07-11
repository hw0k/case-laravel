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
            select: '',
            selection: [],
            Count: 2,
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
            this.Count--;
        },
    },
    name: 'selection-item',
    props: ['idx'],
};
</script>

<style>
</style>
