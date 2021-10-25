<template>
  <section class="mt-5 pt-5 border-t-2 border-solid border-gray-400">
    <div class="font-medium">{{ __("Description") }}</div>
    <div class="space-y-5 mt-2 text-gray-800 font-light" v-html="detail"></div>
  </section>
</template>

<script>
export default {
    props: ['detail']
};
</script>
