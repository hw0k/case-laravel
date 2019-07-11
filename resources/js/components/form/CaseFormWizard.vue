<template>
  <form-wizard
    color="rgba(var(--vs-primary), 1)"
    errorColor="rgba(var(--vs-danger), 1)"
    :title="$props.title"
    :subtitle="$props.subtitle"
    @on-complete="$emit('onSubmit')"
  >
    <template slot="step" slot-scope="props">
      <wizard-step
        :tab="props.tab"
        :transition="props.transition"
        :key="props.tab.title"
        :index="props.index"
      >
      </wizard-step>
    </template>
    <slot />
    <template slot="footer" slot-scope="props">
      <div class="wizard-footer-right">
        <wizard-button
          @click.native="props.nextTab()"
          :style="props.fillButtonStyle"
        >
          생성</wizard-button
        >
      </div>
    </template>
  </form-wizard>
</template>

<script>
export default {
    name: 'case-form-wizard',
    props: ['title', 'subtitle'],
};
</script>

<style>
</style>
