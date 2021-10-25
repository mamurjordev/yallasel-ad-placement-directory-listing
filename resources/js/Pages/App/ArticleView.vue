<template>
    <app-layout>
        <div class="flex justify-center max-h-120 mt-3 overflow-hidden">
            <img
                class="w-screen h-full self-center"
                :src="'/media/articles/' + article.image"
                alt=""
            />
        </div>
        <div class="container mx-auto py-8">
            <div class="font-semibold text-4xl">{{ article.title }}</div>
            <div class="mt-3" v-html="article.text"></div>
        </div>
    </app-layout>
</template>

<script>
import appLayout from "@/Layouts/AppLayout";
export default {
    props: ["article"],
    components: {
        appLayout
    }
};
</script>
