<template>
  <ul>
    <li>
      <label class="vs-component con-vs-radio vs-radio-primary">
        <input name="" class="vs-radio--input" :value="true" type="radio" v-model="answer" checked>
        <span class="vs-radio">
          <span class="vs-radio--borde" style="border: 2px solid rgb(200, 200, 200);"></span>
          <span class="vs-radio--circle"></span>
        </span>
        <span class="vs-radio--label">O</span>
      </label>
    </li>
    <li>
      <label class="vs-component con-vs-radio vs-radio-primary">
        <input name="" class="vs-radio--input" :value="false" type="radio" v-model="answer">
        <span class="vs-radio">
          <span class="vs-radio--borde" style="border: 2px solid rgb(200, 200, 200);"></span>
          <span class="vs-radio--circle"></span>
        </span>
        <span class="vs-radio--label">X</span>
      </label>
    </li>
  </ul>
</template>

<script>
export default {
    name: 'o-x-view',
    data() {
        return {
            answer: true,
        };
    },
};
</script>

<style>

</style>
