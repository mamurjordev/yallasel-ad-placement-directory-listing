<template>
  <section
    class="border border-solid border-gray-400 p-5 mt-6 flex justify-between overflow-hidden"
  >
    <div class="">
      <div class="text-lg font-medium mb-3">
        {{ __("Contract of sale") }}
      </div>
      <div class="text-light text-gray-700">
        <i class="fas fa-check text-green-400 pe-2"></i>
        {{ __("7 days free insurance from Trygg-Hansa") }} -
        <a href="#!" class="">Read more</a>
      </div>
      <div class="text-light text-gray-700">
        <i class="fas fa-check text-green-400 pe-2"></i>
        {{ __("Simple - Filled with vehicle details") }}
      </div>
      <div class="text-light text-gray-700">
        <i class="fas fa-check text-green-400 pe-2"></i>
        {{ __("Secure - Signed with BankID by both parties") }}
      </div>
      <div class="mt-6"></div>
      <a
        href="#!"
        class="border border-solid border-gray-400 rounded-md px-10 py-2"
        >Digital purchase contract</a
      >
    </div>
    <div class="flex items-center">
      <img src="media/site/contract.svg" alt="" class="" />
    </div>
  </section>
</template>

<script>
export default {};
</script>
