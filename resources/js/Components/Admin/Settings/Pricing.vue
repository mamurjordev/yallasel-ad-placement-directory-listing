<template>
    <div class="p-5">
        <h1 class="font-semibold">Pricing Settings</h1>
        <div v-if="success" class="text-green-600 font-semibold mt-2">
            {{ success }}
        </div>
        <form @submit.prevent="submit" class="my-5">
            <div class="space-y-5">
                <label for="toggleB" class="relative grid grid-cols-3">
                    <span class="font-semibold me-5">Free Post:</span>
                    <div class="flex items-center cursor-pointer col-span-2">
                        <!-- toggle -->
                        <div class="relative">
                            <!-- input -->
                            <input
                                type="checkbox"
                                id="toggleB"
                                class="sr-only"
                                v-model="form.free_post"
                            />
                            <!-- line -->
                            <div
                                class="block bg-gray-600 w-14 h-8 rounded-full"
                            ></div>
                            <!-- dot -->
                            <div
                                class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"
                            ></div>
                        </div>
                        <!-- label -->
                        <div class="ml-3 text-gray-700 font-medium">
                            {{ form.free_post ? "Enabled" : "Disabled" }}
                        </div>
                    </div>
                </label>
                <div class="grid grid-cols-3 items-center gap-3">
                    <label for="title" class="text-sm font-semibold"
                        >Ad boost pricing (USD):</label
                    >
                    <input
                        id="title"
                        v-model="form.ad_boost_price"
                        type="number"
                        class="py-1 rounded w-full col-span-2"
                    />
                </div>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white rounded px-10 py-2 mt-5 hover:shadow-xl"
            >
                Update
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: ["setting"],
    data() {
        return {
            form: {
                _method: "put",
                free_post: false,
                ad_boost_price: 1
            }
        };
    },
    mounted() {
        if (this.setting) {
            this.form.free_post = this.setting.free_post == 1 ? true : false;
            this.form.ad_boost_price = this.setting.ad_boost_price;
        }
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        },
        created() {
            if (this.setting.free_post) {
                var free_post = this.setting.free_post == 1 ? true : false;
                this.form.free_post = free_post;
            }
        }
    },
    methods: {
        async submit() {
            var _this = this;
            await this.$inertia.post("/panel/setting/update", this.form);
            setTimeout(function() {
                _this.$page.props.flash.success = null;
            }, 3500);
        }
    }
};
</script>
<style scoped>
input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #48bb78;
}
</style>
