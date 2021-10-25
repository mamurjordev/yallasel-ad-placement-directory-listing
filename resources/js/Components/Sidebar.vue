<template>
    <div class="px-5 py-2 bg-white shadow mt-5 md:mt-0 w-full">
        <!-- {{ widgets }} -->
        <div v-for="(widget, index) in widgets" :key="index" class="space-y-3">
            <div
                v-for="(widgetItem, index) in JSON.parse(widget.widget)"
                :key="index"
                class="border-b border-gray-300 pb-3"
            >
                <a target="_blank" :href="widgetItem.link">
                    <div class="font-semibold">{{ widgetItem.title }}</div>
                    <img
                        :src="'/media/widget/' + widgetItem.image"
                        alt=""
                        class="w-full h-36 my-2 border border-gray-100"
                    />
                    <div class="text-sm" v-html="widgetItem.text"></div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["widgets"]
};
</script>
