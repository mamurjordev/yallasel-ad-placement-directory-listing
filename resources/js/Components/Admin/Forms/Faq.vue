<template>
    <div class="w-full md:px-4">
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
        >
            <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-gray-800 text-xl font-bold capitalize">
                        {{ formName }}
                    </h6>
                    <inertia-link
                        as="button"
                        :href="$route('panel.article.index')"
                        class="block float-right bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        preserve-scroll
                    >
                        {{ formName }} List
                    </inertia-link>
                </div>
            </div>
            <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <h6
                        class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                    >
                        Faq Information
                    </h6>
                    <div class="flex flex-wrap">
                        <div class="w-1/4 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Language
                                </label>
                                <select
                                    v-model="form.language_id"
                                    class="cursor-pointer px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                >
                                    <option
                                        v-for="language in languages"
                                        :key="language.id"
                                        :value="language.id"
                                        class="capitalized"
                                    >
                                        {{ language.language_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-1/4 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    category
                                </label>
                                <select
                                    v-model="form.category"
                                    class="cursor-pointer px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                >
                                    <option
                                        value="manage-ad"
                                        class="capitalized"
                                    >
                                        Manage ad
                                    </option>
                                    <option value="business" class="capitalized"
                                        >Business</option
                                    >
                                    <option
                                        value="customer-safety"
                                        class="capitalized"
                                    >
                                        Customer safety
                                    </option>
                                    <option
                                        value="other-question"
                                        class="capitalized"
                                    >
                                        Other questions
                                    </option>
                                </select>
                                <p class="text-red-500" v-if="errors.category">
                                    {{ errors.category }}
                                </p>
                            </div>
                        </div>
                        <div class="w-2/4 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Sub category
                                </label>
                                <div v-if="other" class="flex justify-between">
                                    <input
                                        type="text"
                                        v-model="form.sub_category"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    />
                                    <i
                                        @click="other = false"
                                        class="fas fa-times self-center ps-3 text-red-600 cursor-pointer"
                                    ></i>
                                </div>
                                <div v-else>
                                    <select
                                        @change="changeSubs()"
                                        v-model="form.sub_category"
                                        class="cursor-pointer px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    >
                                        <option
                                            v-for="(sub_category,
                                            index) in sub_categories"
                                            :key="index"
                                            :value="sub_category.sub_category"
                                            class="capitalized cursor-pointer text-lg"
                                        >
                                            {{ sub_category.sub_category }}
                                        </option>
                                        <optgroup>
                                            <option
                                                class="capitalized cursor-pointer text-lg"
                                                value="customCategory"
                                            >
                                                Other
                                            </option>
                                        </optgroup>
                                    </select>
                                    <p
                                        class="text-red-500"
                                        v-if="errors.sub_category"
                                    >
                                        {{ errors.sub_category }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Title
                                </label>
                                <input
                                    type="text"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    v-model="form.title"
                                />
                                <p class="text-red-500" v-if="errors.title">
                                    {{ errors.title }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap">
                        <div class="w-full md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                    style="white-space: pre-line"
                                >
                                    Details
                                </label>
                                <vue-editor
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                    v-model="form.details"
                                    :editorToolbar="customToolbar"
                                ></vue-editor>
                                <p class="text-red-500" v-if="errors.details">
                                    This Article field is required
                                </p>
                            </div>

                            <div class="w-full lg:w-6/12">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password"
                                    >
                                        Status
                                    </label>
                                    <select
                                        v-model="form.status"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    >
                                        <option value="publish">Publish</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button
                            class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-sm mt-4 mx-4 px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="submit"
                            :disabled="form.processing"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
    components: {
        VueEditor
    },
    props: ["formName", "errors", "faq", "sub_categories", "languages"],
    data: function() {
        return {
            other: false,
            form: this.$inertia.form({
                _method: "post",
                category: "manage-ad",
                params: "",
                sub_category: "",
                title: "",
                details: "",
                status: "publish",
                language_id: 1
            }),
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
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                [{ direction: "rtl" }]
            ]
        };
    },
    methods: {
        submit() {
            this.form.params = this.form.category.split(" ").join("-_");
            this.form.category = this.form.category.split("-").join(" ");
            var data = new FormData();
            data.append("category", this.form.category.split("-").join(" "));
            data.append("params", this.form.category);
            data.append("sub_category", this.form.sub_category);
            data.append("title", this.form.title);
            data.append("details", this.form.details);
            data.append("status", this.form.status);
            data.append("language_id", this.form.language_id);

            if (this.faq) {
                this.form.post(this.route("panel.faq.update", this.faq.id));
            } else {
                this.$inertia.post("/panel/faq", data);
            }
        },
        changeSubs() {
            if (this.form.sub_category == "customCategory") {
                this.other = true;
                this.form.sub_category = "";
            } else {
                this.other = false;
            }
        }
    },

    created() {
        if (this.faq) {
            this.form._method = "put";
            this.form.category = this.faq.params;
            this.form.sub_category = this.faq.sub_category;
            this.form.title = this.faq.title;
            this.form.status = this.faq.status;
            this.form.details = this.faq.details;
            this.form.language_id = this.faq.language_id;
        }
    }
};
</script>
