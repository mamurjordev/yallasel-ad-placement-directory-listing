<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
                >
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="flex flex-col">
                            <h6
                                class="text-gray-800 text-xl font-bold capitalize"
                            >
                                Edit Page
                            </h6>

                            <p class="font-semibold text-gray-700">
                                Terms of use
                            </p>
                        </div>
                    </div>
                    <div
                        v-if="success"
                        class="bg-green-100 text-green-900 border border-green-900 font-semibold rounded mx-10 px-5 py-1 mt-5"
                    >
                        {{ success }}
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <form @submit.prevent="submit" class="space-y-5">
                            <vue-editor
                                class="mt-10 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                v-model="form.content"
                                :editorToolbar="customToolbar"
                            ></vue-editor>
                            <p
                                v-if="errors.content"
                                class="text-sm text-red-600 font-semibold"
                            >
                                {{ errors.content }}
                            </p>
                            <button
                                type="submit"
                                class="bg-blue-600 text-white font-semibold px-10 py-1 rounded"
                            >
                                UPDATE
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import { VueEditor } from "vue2-editor";
export default {
    props: ["page", "errors"],
    components: {
        AdminLayout,
        VueEditor
    },
    data() {
        return {
            form: {
                content: this.page.content
            },
            customToolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ size: ["small", false, "large", "huge"] }],
                [{ header: 1 }, { header: 2 }],
                ["bold", "italic", "underline", "strike"],
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                [{ font: [] }],
                ["blockquote"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                [{ direction: "rtl" }]
            ]
        };
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            this.$inertia.post("/panel/page/terms-of-use", this.form);
        }
    }
};
</script>
