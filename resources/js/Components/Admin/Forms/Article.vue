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
                        Article Information
                    </h6>
                    <div class="flex flex-wrap">
                        <div class="w-full md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Language
                                </label>
                                <select
                                    v-model="form.language"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
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
                        <div class="w-full md:px-4">
                            <div class="relative w-full mb-3">
                                <img :src="form.image" alt="" />
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Image
                                </label>
                                <div class="">
                                    <img
                                        v-if="uploadedImage && !preViewImage"
                                        :src="
                                            '/media/articles/' + uploadedImage
                                        "
                                        alt="cover image"
                                        class="h-28 w-auto mb-2"
                                    />
                                    <img
                                        v-if="preViewImage"
                                        :src="preViewImage"
                                        alt="cover image"
                                        class="h-28 w-auto mb-2"
                                    />
                                </div>
                                <input
                                    ref="photo"
                                    @change="image"
                                    type="file"
                                    name="image"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                />
                                <p class="text-red-500" v-if="errors.Image">
                                    {{ errors.Image }}
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
                                    Article
                                </label>
                                <!-- <textarea
                  v-model="form.text"
                  type="text"
                  class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                  rows="4"
                ></textarea> -->
                                <vue-editor
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                    v-model="form.text"
                                    :editorToolbar="customToolbar"
                                ></vue-editor>
                                <p class="text-red-500" v-if="errors.text">
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
                                        v-model="form.Status"
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
    props: {
        formName: String,
        errors: Object,
        article: Object,
        languages: Array
    },
    data: function() {
        return {
            form: this.$inertia.form({
                _method: "post",
                title: "",
                Image: "",
                Status: "publish",
                text: "",
                language: 1
            }),
            preViewImage: null,
            uploadedImage: null,
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
            var data = new FormData();
            data.append("title", this.form.title);
            data.append("Image", this.form.Image);
            data.append("Status", this.form.Status);
            data.append("text", this.form.text);
            data.append("language", this.form.language);

            if (this.article) {
                this.form.post(
                    this.route("panel.article.update", this.article.id)
                );
            } else {
                this.$inertia.post("/panel/article", data);
            }
        },

        image: function(e) {
            this.form.Image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.Image);
            reader.onload = e => {
                this.preViewImage = e.target.result;
            };
        }
    },

    created() {
        if (this.article) {
            this.form._method = "put";
            this.uploadedImage = this.article.image;
            this.form.title = this.article.title;
            this.form.Status = this.article.status;
            this.form.text = this.article.text;
            this.form.language = this.article.language;
        }
    }
};
</script>
