<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
                >
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6
                                class="text-gray-800 text-xl font-bold capitalize"
                            >
                                Edit Category
                            </h6>
                            <inertia-link
                                :href="$route('panel.category.index')"
                                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                preserve-scroll
                            >
                                Category List
                            </inertia-link>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <form
                            @submit.prevent="submit"
                            enctype="multipart/form-data"
                        >
                            <h6
                                class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                            >
                                Category Information
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Category Name
                                        </label>
                                        <input
                                            type="text"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                            v-model="form.CategoryName"
                                        />
                                        <p
                                            class="text-red-500 text-sm font-semibold"
                                            v-if="errors.CategoryName"
                                        >
                                            {{ errors.CategoryName }}
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Category Name (Arabic)
                                        </label>
                                        <input
                                            dir="rtl"
                                            type="text"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                            v-model="form.CategoryNameAr"
                                        />
                                        <p
                                            class="text-red-500 text-sm font-semibold"
                                            v-if="errors.CategoryNameAr"
                                        >
                                            This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Parent Category
                                        </label>
                                        <select
                                            v-model="form.parentCategory"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        >
                                            <option value="">
                                                none
                                            </option>
                                            <option
                                                v-for="category in categories"
                                                :key="category.id"
                                                :value="category.id"
                                            >
                                                {{ category.category_name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <img :src="form.photoPreview" alt="" />
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Image {{ form.photoPreview }}
                                        </label>
                                        <input
                                            ref="photo"
                                            @change="updatePhotoPreview"
                                            type="file"
                                            name="image"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Status {{ form.Status }}
                                        </label>
                                        <select
                                            v-model="form.Status"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        >
                                            <option value="publish"
                                                >Publish</option
                                            >
                                            <option value="pending"
                                                >Pending</option
                                            >
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr
                                class="hidden mt-6 border-b-1 border-gray-400"
                            />

                            <h6
                                class="hidden text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                            >
                                Post
                            </h6>
                            <div class="hidden flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Max Image allowed per post
                                            {{ form.maxImagePerPost }}
                                        </label>
                                        <input
                                            v-model="form.maxImagePerPost"
                                            type="number"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            htmlFor="grid-password"
                                        >
                                            Post validity interval (Days)
                                            {{ form.postValidityInterval }}
                                        </label>
                                        <input
                                            v-model="form.postValidityInterval"
                                            type="number"
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        />
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-6 border-b-1 border-gray-400" />

                            <h6
                                class="text-gray-500 text-sm mt-3 mb-6 font-bold uppercase"
                            >
                                Properties
                            </h6>
                            <div
                                class="flex flex-wrap"
                                v-for="(property, index) in form.properties"
                                :key="index"
                            >
                                <div
                                    class="relative w-full md:w-2/12 mb-3 px-2"
                                >
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-5"
                                        style="white-space: pre-line"
                                        >Property Icon
                                        <span class="text-2xs text-green-600">
                                            Font Awsome Unicode.
                                        </span>
                                    </label>
                                    <input
                                        v-model="property['property_icon']"
                                        type="text"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        rows="4"
                                        placeholder="f005"
                                    />
                                </div>
                                <div
                                    class="relative w-full md:w-2/12 mb-3 px-2"
                                >
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-5"
                                        style="white-space: pre-line"
                                    >
                                        Property Name
                                        <span class="text-2xs text-green-600"
                                            >(Example: Fuel)</span
                                        >
                                    </label>
                                    <input
                                        v-model="property['property_name']"
                                        type="text"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        rows="4"
                                        placeholder="Fuel"
                                    />
                                </div>
                                <div
                                    class="relative w-full md:w-5/12 mb-3 px-2"
                                >
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password"
                                        style="white-space: pre-line"
                                    >
                                        Property Values
                                        <span class="text-2xs text-green-600"
                                            >(Example: Diesel, Petrol)</span
                                        >
                                    </label>
                                    <tags-input
                                        element-id="tags"
                                        v-model="property['property_values']"
                                        placeholder="Property values"
                                        :typeahead="true"
                                    ></tags-input>
                                </div>
                                <div
                                    class="relative w-full md:w-2/12 mb-3 px-2"
                                >
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-5"
                                        htmlFor="grid-password"
                                        style="white-space: pre-line"
                                    >
                                        Property Unit
                                        <span class="text-2xs text-green-600"
                                            >(Example: Km/h)</span
                                        >
                                    </label>
                                    <input
                                        v-model="property['property_unit']"
                                        type="text"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        rows="4"
                                        placeholder="km/h"
                                    />
                                </div>
                                <div
                                    class="relative w-1/12 mx-5 md:mx-0 mb-8 md:mb-0 md:mt-20"
                                >
                                    <div
                                        @click="removeProperties(index)"
                                        class="bg-red-400 text-white w-max rounded-md shadow-md px-2 cursor-pointer"
                                    >
                                        Remove
                                    </div>
                                </div>
                            </div>

                            <div class="relative w-full mb-3 px-2">
                                <div
                                    @click="addProperties()"
                                    class="bg-green-500 text-white rounded shadow-md mx-auto mt-2 px-4 py-1 cursor-pointer w-max"
                                >
                                    Add new Property
                                </div>
                            </div>
                            <button
                                class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="submit"
                                :disabled="form.processing"
                            >
                                Submit
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
import FormCategory from "@/Components/Admin/Forms/Category";
import VoerroTagsInput from "@voerro/vue-tagsinput";

export default {
    components: {
        AdminLayout,
        FormCategory,
        "tags-input": VoerroTagsInput
    },
    props: ["categories", "category", "categoryProperties", "errors"],
    data: function() {
        return {
            // form: this.$inertia.form({
            form: {
                _method: "PUT",
                CategoryName: this.category.category_name,
                CategoryNameAr: this.category.category_name_ar,
                parentCategory: this.category.parent_category,
                Image: null,
                Status: this.category.status,
                maxImagePerPost: this.category.post_max_images_allow,
                postValidityInterval: this.category.post_validity_interval,

                photoPreview: null,

                properties: []
            }
        };
    },
    created() {
        var a = [];

        this.categoryProperties.forEach(element => {
            var b = {
                property_icon: element.property_icon,
                property_name: element.property_name,
                property_values: this.textField
                    ? null
                    : JSON.parse(element.property_values),
                property_unit: element.property_unit
            };
            a.push(b);
        });

        this.form.properties = a;
    },
    methods: {
        addProperties() {
            this.form.properties.push({
                property_icon: "",
                property_name: "",
                property_values: [],
                property_unit: ""
            });
        },
        removeProperties(index) {
            this.form.properties.splice(index, 1);
        },
        // submit() {
        //     this.form.post(
        //         this.route("panel.category.update", this.category.id)
        //     );
        // },

        submit() {
            var data = new FormData();
            data.append("_method", "PUT");
            data.append("CategoryName", this.form.CategoryName);
            data.append("CategoryNameAr", this.form.CategoryNameAr);
            data.append("parentCategory", this.form.parentCategory);
            data.append("Image", this.form.Image);
            data.append("Status", this.form.Status);
            data.append("post_max_images_allow", this.form.maxImagePerPost);
            data.append(
                "post_validity_interval",
                this.form.postValidityInterval
            );
            data.append("properties", JSON.stringify(this.form.properties));
            // data.append("properties", this.properties);

            this.$inertia.post("/panel/category/" + this.category.id, data);
        },

        updatePhotoPreview(e) {
            this.form.Image = e.target.files[0];
            this.form.photoPreview = e.target.files[0]["name"];
        }
    }
};
</script>
