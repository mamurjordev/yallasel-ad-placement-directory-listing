<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4 font-notosans">
            <div class="w-full md:px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
                >
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6
                                class="text-gray-800 text-xl font-bold capitalize"
                            >
                                Site Settings
                            </h6>
                            <div
                                @click="submit()"
                                as="button"
                                class="cursor-pointer block float-right bg-green-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                preserve-scroll
                            >
                                Save Changes
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                        <form
                            @submit.prevent="submit"
                            enctype="multipart/form-data"
                        >
                            <h6
                                class="text-gray-500 text-sm mt-3 mb-3 font-bold uppercase"
                            >
                                Site Settings
                            </h6>
                            <p v-if="success" class="text-green-500 mb-3">
                                {{ success }}
                            </p>
                            <div class="flex flex-wrap">
                                <div class="w-full md:px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Free Post
                                        </label>
                                        <div class="mt-3 w-full mb-12">
                                            <label
                                                for="toggleB"
                                                class="flex items-center cursor-pointer"
                                            >
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
                                                <div
                                                    class="ml-3 text-gray-700 font-medium"
                                                >
                                                    {{
                                                        form.free_post
                                                            ? "Enabled"
                                                            : "Disabled"
                                                    }}
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    type="submit"
                                    class="bg-green-500 text-white px-10 py-2 rounded"
                                >
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import FormArticle from "@/Components/Admin/Forms/Article";
export default {
    props: ["free_post"],
    components: {
        AdminLayout,
        FormArticle
    },
    data: function() {
        return {
            form: {
                _method: "put",
                free_post: false
            }
        };
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            console.log(this.form.free_post);
            this.$inertia.post("/panel/setting/update", this.form);
        }
    },
    created() {
        if (this.free_post) {
            var free_post = this.free_post.value == 1 ? true : false;
            this.form.free_post = free_post;
        }
    }
};
</script>
