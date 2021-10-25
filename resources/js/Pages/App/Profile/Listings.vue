<template>
  <app-layout>
    <!-- Unpublished ads -->
    <section class="bg-red-50 pb-5">
      <section
        class="lg:container w-full px-5 lg:mx-auto md:grid grid-cols-6 gap-3"
      >
        <!-- Main -->
        <section class="col-span-4">
          <!-- title -->
          <button class="my-4 font-bold cursor-pointer focus:outline-none" @click="visibiliy">
            {{ __("Unpublished ads") }} <i :class="arrow" class="fas ps-2"></i>
          </button>

          <!-- ADS -->
          <section :class="[isHidden ? 'hidden' : '']" class="space-y-4">
            <!-- AD -->
            <section
              class="shadow-md p-3 bg-white rounded-md border-b-2 border-gray-500"
            >
              <div class="md:grid grid-cols-7 gap-5">
                <img
                  src="/media/product/car1.jpg"
                  alt="car1"
                  class="w-full h-40 col-span-3 lg:col-span-2 mb-4 md:mb-0"
                />
                <div class="col-span-4 lg:col-span-5">
                  <div class="flex justify-between border-b pb-4">
                    <div class="font-medium">
                      <span class="block text-xs text-gray-600"
                        >Rooms in Apartment - 1room 12m<sup>2</sup></span
                      >
                      Gotgatan
                    </div>
                    <div class="cursor-pointer">
                      <i
                        class="fas fa-pencil-alt border border-black rounded-md p-3"
                      ></i>
                    </div>
                  </div>
                  <div
                    class="grid grid-cols-2 grid-rows-2 gap-2 mt-2 text-gray-600 font-medium"
                  >
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 mt-4">
                <button class="bg-gray-400 text-gray-700 py-2 rounded">
                  {{ __("Not published") }}
                </button>
                <button class="bg-green-500 text-white py-2 rounded text-sm">
                  {{ __("Preview") }}
                </button>
              </div>
            </section>
            <section
              class="shadow-md p-3 bg-white rounded-md border-b-2 border-gray-500"
            >
              <div class="md:grid grid-cols-7 gap-5">
                <img
                  src="/media/product/car1.jpg"
                  alt="car1"
                  class="w-full h-40 col-span-3 lg:col-span-2 mb-4 md:mb-0"
                />
                <div class="col-span-4 lg:col-span-5">
                  <div class="flex justify-between border-b pb-4">
                    <div class="font-medium">
                      <span class="block text-xs text-gray-600"
                        >Rooms in Apartment - 1room 12m<sup>2</sup></span
                      >
                      Gotgatan
                    </div>
                    <div class="cursor-pointer">
                      <i
                        class="fas fa-pencil-alt border border-black rounded-md p-3"
                      ></i>
                    </div>
                  </div>
                  <div
                    class="grid grid-cols-2 grid-rows-2 gap-2 mt-2 text-gray-600 font-medium"
                  >
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                    <div class=""><i class="fas fa-coins"></i> 7,000 IQD</div>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 mt-4">
                <button class="bg-gray-400 text-gray-700 py-2 rounded">
                  {{ __("Not published") }}
                </button>
                <button class="bg-green-500 text-white py-2 rounded text-sm">
                  {{ __("Preview") }}
                </button>
              </div>
            </section>
          </section>
        </section>
        <!-- Sidebar -->
        <section
          class="col-span-2 w-full shadow-md mt-3 p-3 bg-white rounded-md"
        >
          <div class="font-semibold">
            <i class="fas fa-question-circle text-primary pe-1"></i>
            {{ __("My ads") }}
          </div>
          <ul class="text-primary font-semibold text-sm mt-5 space-y-5">
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
            <li>
              <i class="fas fa-angle-right pe-2"></i>
              {{ __("What should I keep in mind when creating my ad?") }}
            </li>
          </ul>
        </section>
      </section>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
  data: function () {
    return {
      isHidden: true,
      arrow: "fa-angle-down",
    };
  },
  methods: {
    visibiliy: function () {
      this.isHidden = !this.isHidden;
      this.arrow =
        this.arrow == "fa-angle-down" ? "fa-angle-up" : "fa-angle-down";
    },
  },
};
</script>
