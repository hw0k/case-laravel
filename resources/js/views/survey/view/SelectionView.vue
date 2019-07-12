<template>
  <ul>
    <li v-for="(option, i) in options" :key="i">
      <label class="vs-component con-vs-radio vs-radio-primary">
        <input name="" class="vs-radio--input" :value="option" type="radio" v-model="answer">
        <span class="vs-radio">
          <span class="vs-radio--borde" style="border: 2px solid rgb(200, 200, 200);"></span>
          <span class="vs-radio--circle"></span>
        </span>
        <span class="vs-radio--label">{{ option }}</span>
      </label>
    </li>
  </ul>
</template>

<script>
export default {
    name: 'selection-view',
    data() {
        return {
            // props로 옮겨야 됨.
            options: [
                '1',
                '2',
                '3',
                '4',
            ],
        };
    },
};
</script>

<style>

</style>
