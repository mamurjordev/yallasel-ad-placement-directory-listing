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
        {{ __("choose location") }}
      </div>
    </section>
    <section
      class="container mx-auto px-5 bg-white space-y-8 py-5 text-gray-700"
    >
      <div v-for="city in cities" :key="city.id">
        <inertia-link :href="'/account/location/region/' + city.id" class="">
          <div class="">
            {{ city.city_name }}
            <i class="fas fa-chevron-right float-end"></i>
          </div>
        </inertia-link>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
  props: ["cities"],
  components: {
    AppLayout,
  },
};
</script>
