<template>
    <app-layout>
        <div class="container mx-auto px-5 py-10">
            <h1 class="text-center font-bold text-xl">
                -{{ __("Terms of use") }}-
            </h1>
            <div class="my-5" v-html="page.content"></div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    props: ["page"],
    components: {
        AppLayout
    }
};
</script>
