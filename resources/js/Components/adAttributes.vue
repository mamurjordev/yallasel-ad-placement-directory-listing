<template>
    <section class="border-t border-solid border-gray-400 mt-8">
        <div class="text-2xl text-gray-700 font-semibold my-5">
            {{ __("Fact") }}
        </div>
        <div
            class="grid grid-flow-row grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4 text-gray-800"
        >
            <div
                v-for="(attribute, index) in JSON.parse(
                    post_attributes.post_attribute
                )"
                :key="index"
                class="flex justify-start"
            >
                <i
                    class="text-4xl pt-2 me-4 icon-before fa fas"
                    v-html="'&#x'+attribute.icon+';'"
                ></i>
                <div class="">
                    <p class="text-gray-700 font-light capitalize">
                        {{ index }}
                    </p>
                    <p class="font-medium capitalize">
                        {{ attribute.value + " " + attribute.unit }}
                    </p>
                </div>
            </div>
        </div>
        <!-- <div class="text-primary mt-2">
            <i class="fas fa-plus text-sm"></i> {{ __("Show more") }}
        </div> -->
    </section>
</template>

<script>
export default {
    props: ["post_attributes"],
    filters: {
        unescape: v => unescape(v)
    }
};
</script>
