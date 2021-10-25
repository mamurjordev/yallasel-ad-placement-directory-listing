<template>
  <app-layout>
    <section
      class="container mx-auto flex px-5 font-medium text-gray-800 bg-white border-b border-gray-300 py-5"
    >
      <inertia-link href="/account" class="">
        <i class="fas fa-chevron-left"></i>
        {{ __("Back") }}
      </inertia-link>
      <div class="flex-grow text-center text-xl">
        {{ city.city_name }}
      </div>
    </section>
    <section class="container mx-auto px-5 bg-white py-5 text-gray-700">
      <div
        @click="inputRegion()"
        class="flex justify-between border-b border-gray-300 pb-4 cursor-pointer"
      >
        <div class="">{{ __("The whole of") }}</div>
        {{ city.city_name }}
        <i class="far fa-circle"></i>
      </div>
      <div
        @click="inputRegion(region.id)"
        v-for="region in regions"
        :key="region.id"
        class="px-4 cursor-pointer py-5"
      >
        {{ region.region_name }}
        <i class="far fa-circle float-end"></i>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
  props: ["city", "regions", "accountSetting"],
  components: {
    AppLayout,
  },

  data: function () {
    return {
      form: this.$inertia.form({
        city_id: this.city.id,
        region_id: "",
      }),
    };
  },

  methods: {
    inputRegion(region_id) {
      this.form.region_id = region_id;

      this.$inertia.put("/account/" + this.accountSetting.id, this.form);
    },
  },
};
</script>
