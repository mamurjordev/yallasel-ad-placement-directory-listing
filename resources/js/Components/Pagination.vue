<template>
    <section class="container mx-auto mt-6">
        <div class="text-gray-700 font-light lowercase">
            <span class="font-medium">{{ from }}-{{ to }}</span>
            {{ __("of total") }}
            <span class="font-medium">{{ total }}</span>
            {{ __("Search") }}
        </div>
        <div class="flex justify-center mt-5">
            <div
                class="flex justify-center bg-white border border-solid border-gray-400 rounded"
            >
                <inertia-link
                    v-for="link in links"
                    :key="link.id"
                    :href="link.url ? link.url : ''"
                    v-html="link.label"
                    :class="[
                        link.active == true ? 'text-white bg-btn' : '',
                        link.url ? '' : 'hidden',
                        hideInMobile(link.label) ? 'hidden' : ''
                    ]"
                    class="px-5 py-2 border-e border-solid border-gray-400"
                ></inertia-link>
            </div>
        </div>
        <div class="flex justify-center mt-10">
            <inertia-link
                :href="this.$page.url"
                class="text-gray-600 font-light border border-solid border-gray-400 rounded px-5 py-2"
            >
                <i class="fas fa-redo me-2"></i> {{ __("New ads") }}
            </inertia-link>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        links: Array,
        total: Number,
        from: Number,
        to: Number
    },
    methods: {
        hideInMobile(label) {
            if (this.isMobile() && typeof label === "number") {
                return true;
            } else {
                return false;
            }
        },
        isMobile() {
            return screen.width <= 760 ? true : false;
        }
    }
};
</script>
