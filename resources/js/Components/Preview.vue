<template>
  <section
    id="previewModal"
    v-bind:class="[isHidden ? 'hidden' : '']"
    class="fixed z-10 top-0 start-0 w-full h-full overflow-auto font-roboto"
  >
    <div class="container mx-auto bg-white mt-5 py-5">
      <div
        class="cursor-pointer underline font-light text-right px-5 mb-6"
        @click="openPreview"
      >
        {{ __("close") }}
      </div>
      <div class="bg-gray-100">
        <div class="flex justify-center">
          <img v-if="mainPreview" :src="mainPreview" alt="" />
          <div v-else class="">
            <img v-if="previewImages[0]" :src="previewImages[0]" alt="" />
          </div>
        </div>
        <div class="flex justify-items-start space-s-3 mt-20 mx-5">
          <!-- <img v-for="previewImage in previewImages" :key="previewImage.id" :src="previewImage" alt="" class="w-12 h-10" /> -->
          <img
            v-if="previewImages[0]"
            :src="previewImages[0]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[0]"
          />
          <img
            v-if="previewImages[1]"
            :src="previewImages[1]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[1]"
          />
          <img
            v-if="previewImages[2]"
            :src="previewImages[2]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[2]"
          />
          <img
            v-if="previewImages[3]"
            :src="previewImages[3]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[3]"
          />
          <img
            v-if="previewImages[4]"
            :src="previewImages[4]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[4]"
          />
          <img
            v-if="previewImages[5]"
            :src="previewImages[5]"
            alt=""
            class="w-12 h-10"
            @click="mainPreview = previewImages[5]"
          />
        </div>
      </div>
      <div class="px-5 mt-3">
        <h5 class="text-2xl">{{ form.heading }}</h5>
        <div class="text-gray-600 font-light text-sm mb-5 mt-2">
          {{ __("For sale by") }} {{ form.name }}
        </div>
        <p v-html="form.text" class="text-gray-600 font-light text-sm">
          {{ form.text }}
        </p>
      </div>
      <div class="text-center bg-gray-50 py-2 text-gray-500 mt-10 mb-5">
        <div class="text-sm font-light">
          {{ __("Email or call") }}
          <span class="font-medium">{{ form.email }}</span>
        </div>
        <div class="text-2xl font-light mt-1">{{ form.phone }}</div>
      </div>
      <div
        class="cursor-pointer underline text-center pb-4"
        @click="openPreview"
      >
        {{ __("Close preview") }}
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["previewImages", "form", "Hidden"],
  data() {
    return {
      mainPreview: null,
    };
  },
  computed: {
    isHidden() {
      return this.Hidden;;
    },
  },
  methods: {
    openPreview: function () {
      this.isHidden = !this.isHidden;
    },
  },
};
</script>

<style scoped>
#previewModal {
  background-color: #2120207a;
}
</style>
