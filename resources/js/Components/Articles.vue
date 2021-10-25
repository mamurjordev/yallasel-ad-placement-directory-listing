<template>
    <section class="container mx-auto mt-10 px-2">
        <div class="grid grid-cols-2 mb-2">
            <h2 class="text-2xl font-medium">
                {{ header }}
            </h2>
            <inertia-link href="/articles" class="text-end text-sm"
                >{{ __("More articles") }}
                <i
                    class="fas fa-chevron-right text-xs"
                    :style="lang == 'ar' ? 'transform: scaleX(-1)' : ''"
                ></i
            ></inertia-link>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <inertia-link
                v-for="article in articles"
                :key="article.id"
                :href="'/article/' + article.id"
                class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden"
            >
                <img
                    :src="'media/articles/' + article.image"
                    :alt="article.title"
                    class="w-full h-36"
                />
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">
                    {{ article.title }}
                </h3>
                <p class="px-2 pb-4 font-normal text-gray-600">
                    {{ truncate(article.text, 120, "...") }}
                </p>
            </inertia-link>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        articles: Array,
        header: String
    },
    methods: {
        truncate(text, length, clamp) {
            clamp = clamp || "...";
            var node = document.createElement("div");
            node.innerHTML = text;
            var content = node.textContent;
            return content.length > length
                ? content.slice(0, length) + clamp
                : content;
        }
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
