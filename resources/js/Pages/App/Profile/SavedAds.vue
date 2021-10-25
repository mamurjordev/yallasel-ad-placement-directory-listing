<template>
    <app-layout>
        <section class="bg-white border-b border-gray-300">
            <div class="container mx-auto space-s-14 flex justify-start">
                <!-- <div
          :class="tab == 1 ? 'border-red-500' : ''"
          class="border-b-2 hover:border-red-500 py-3 cursor-pointer"
          @click="tab = 1"
        >
          {{ __("Surveillance") }}
        </div> -->
                <div
                    :class="tab == 2 ? 'border-red-500' : ''"
                    class="border-b-2 hover:border-red-500 py-3 cursor-pointer"
                    @click="tab = 2"
                >
                    {{ __("saved advertisements") }}
                </div>
            </div>
        </section>
        <section class="container mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mt-6 mb-5">
                {{ __("saved advertisements") }}
            </h1>

            <div class="grid grid-flow-row grid-cols-4 gap-2 mb-10">
                <div
                    href=""
                    v-for="ad in ads"
                    :key="ad.id"
                    class="p-3 bg-white text-gray-800 rounded shadow"
                >
                    <div class="relative mb-4">
                        <inertia-link :href="'/ads/' + ad.post_id">
                            <img :src="'/media/posts/' + ad.image" alt="" />
                        </inertia-link>
                        <i
                            @click="removeFavorite(ad.post_id)"
                            class="fas fa-times absolute text-white bg-gray-700 top-0 end-0 rounded w-6 h-6 text-center pt-1 cursor-pointer z-10"
                        ></i>
                    </div>
                    <inertia-link :href="'/ads/' + ad.post_id">
                        <div class="font-light text-sm">{{ ad.city_name }}</div>
                        <div class="">{{ ad.title }}</div>
                        <div class="font-medium mt-1">
                            {{ ad.expected_price }} IQD
                        </div>
                    </inertia-link>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout";

export default {
    props: ["ads"],
    components: {
        AppLayout
    },
    data() {
        return {
            tab: 2
        };
    },
    methods: {
        removeFavorite(postId) {
            console.log(postId);
            axios.delete("/api/v1/favorite/" + postId);
            Inertia.reload({ only: ["ads"] });
        }
    }
};
</script>
