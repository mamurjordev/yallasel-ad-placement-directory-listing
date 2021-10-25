<template>
    <div class="bg-gray-50 pb-10" :dir="language == 'ar' ? 'rtl' : 'ltr'">
        <HeaderVue />
        <!-- Header -->
        <section
            class="md:container mx-auto px-3 flex justify-between font-roboto my-3"
        >
            <inertia-link href="/" class="text-red-500 text-3xl font-black"
                >Yallasell</inertia-link
            >
            <inertia-link
                href="/account"
                :class="language == 'ar' ? 'flex-row-reverse' : ''"
                class="self-end flex items-center gap-3"
            >
                <i class="fas fa-user"></i>
                {{ user.name }}
            </inertia-link>
        </section>

        <form
            @submit.prevent="submit"
            class="md:container mx-auto bg-white border border-gray-300 py-5 px-4 font-roboto"
            enctype="multipart/form-data"
        >
            <div class="flex justify-start items-baseline space-s-5 mb-5">
                <div class="text-4xl font-medium font-sans">
                    {{ __("Post an ad on Yallasell") }}
                </div>
            </div>
            <div class="space-s-3">
                <label for="" class="text-sm">
                    <input
                        type="radio"
                        name="posttype"
                        class="w-3 h-3 focus:ring-0 cursor-pointer"
                        value="1"
                        v-model="form.is_individual"
                    />
                    {{ __("Private person") }}
                </label>
                <label for="" class="text-sm">
                    <input
                        type="radio"
                        name="posttype"
                        class="w-3 h-3 focus:ring-0 cursor-pointer"
                        value="0"
                        v-model="form.is_individual"
                    />
                    {{ __("Business") }}
                </label>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">{{
                    __("Name")
                }}</label>
                <input
                    type="text"
                    v-model="form.name"
                    class="block py-3 md:py-1 w-full md:w-2/6 border-gray-400 rounded"
                />
                <p class="text-red-500" v-if="errors.name">
                    {{ errors.name }}
                </p>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">{{
                    __("E-mail")
                }}</label>
                <input
                    type="email"
                    class="readonly block py-3 md:py-1 w-full md:w-2/6 border-gray-400 rounded"
                    readonly
                    v-model="form.email"
                />
                <p class="text-red-500" v-if="errors.email">
                    {{ errors.email }}
                </p>
            </div>
            <div class="md:grid grid-cols-6 md:space-s-8">
                <div class="mt-3 col-span-2">
                    <label for="" class="text-sm font-medium">{{
                        __("Phone")
                    }}</label>
                    <input
                        type="tel"
                        placeholder="+964 *********"
                        v-model="form.phone"
                        class="block py-3 md:py-1 w-full col-span-2 border-gray-400 rounded"
                    />
                    <p class="text-red-500" v-if="errors.phone">
                        {{ errors.phone }}
                    </p>
                </div>
                <label for="" class="font-light col-span-4 mt-10">
                    <input
                        type="checkbox"
                        v-model="form.hidePhoneInAd"
                        class="w-3 h-3 focus:ring-0"
                        checked
                    />
                    {{ __("hide in the ad") }}
                </label>
            </div>
            <!-- category -->
            <div class="mt-3">
                <label for="" class="text-sm font-medium">
                    {{ __("Category") }}
                </label>
                <select
                    class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0 capitalize"
                    v-model="form.category_id"
                >
                    <option value="" disabled>Choose a Category</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                        selected
                        class="capitalize"
                        @click="getCatProperties()"
                    >
                        {{ category.category_name }}
                    </option>
                </select>
                <p class="text-red-500" v-if="errors.category_id">
                    {{ errors.category_id }}
                </p>
            </div>
            <!-- reason -->
            <div
                class="my-5 text-sm grid md:block grid-flow-col grid-rows-2 space-s-3"
            >
                <label for="" class="cursor-pointer">
                    <input
                        type="radio"
                        name="postreason"
                        value="for-sale"
                        v-model="form.reason"
                        class="focus:ring-0 cursor-pointer"
                    />
                    {{ __("For sale") }}
                </label>
                <label for="" class="cursor-pointer">
                    <input
                        type="radio"
                        name="postreason"
                        value="for-rent"
                        v-model="form.reason"
                        class="focus:ring-0 cursor-pointer"
                    />
                    {{ __("For rent") }}
                </label>
                <label for="" class="cursor-pointer">
                    <input
                        type="radio"
                        name="postreason"
                        value="wish-to-rent"
                        v-model="form.reason"
                        class="focus:ring-0 cursor-pointer"
                    />
                    {{ __("Wish to rent") }}
                </label>
                <label for="" class="cursor-pointer">
                    <input
                        type="radio"
                        name="postreason"
                        value="wish-to-purchase"
                        v-model="form.reason"
                        class="focus:ring-0 cursor-pointer"
                    />
                    {{ __("Wish to Purchase") }}
                </label>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">{{
                    __("City")
                }}</label>
                <select
                    class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0"
                    v-model="form.city_id"
                >
                    <option
                        v-for="city in cities"
                        :key="city.id"
                        :value="city.id"
                    >
                        {{ city.city_name }}
                    </option>
                </select>
                <p class="text-red-500" v-if="errors.city_id">
                    {{ errors.city_id }}
                </p>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">
                    {{ __("Region") }}
                </label>
                <select
                    class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0"
                    v-model="form.region_id"
                >
                    <option
                        v-for="region in regions"
                        :key="region.id"
                        :value="region.id"
                    >
                        {{ region.region_name }}
                    </option>
                </select>
                <p class="text-red-500" v-if="errors.region_id">
                    {{ errors.region_id }}
                </p>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">{{
                    __("ZIP code")
                }}</label>
                <input
                    type="text"
                    class="border-gray-400 block py-3 md:py-1 rounded w-full md:w-32"
                    v-model="form.zipcode"
                />
                <p class="text-red-500" v-if="errors.zipcode">
                    {{ errors.zipcode }}
                </p>
            </div>

            <!-- Dynamic category Properties -->
            <div
                v-if="categoryProperties"
                class="mt-3 bg-gray-100 p-4 w-10/12 pe-20"
            >
                <div v-if="form.category_id == 1" class="">
                    <label for="registration">{{
                        __("Registration no")
                    }}</label>
                    <div class="space-s-2 mt-1">
                        <input
                            type="text"
                            placeholder="ABC123"
                            class="py-1 w-32"
                            v-model="form.registration_no"
                        />
                        <button
                            class="bg-btn text-white py-2 px-5 text-sm rounded"
                        >
                            {{ __("Get car details") }}
                        </button>
                    </div>
                    <p class="text-red-500" v-if="errors.registration_no">
                        {{ errors.registration_no }}
                    </p>
                    <p class="text-sm font-light mt-2">
                        {{
                            __(
                                "The registration number does not appear in the ad. We use it to pick up the car's equipment, model year, mileage, fuel type etc. So that you do not have to fill it in yourself!"
                            )
                        }}
                    </p>
                </div>

                <section
                    v-if="categoryProperties"
                    class="grid grid-flow-row grid-cols-3 gap-x-10 gap-y-2 border-t border-gray-400 pt-2 mt-8"
                >
                    <div
                        v-for="(categoryProperty, index) in categoryProperties"
                        :key="index"
                        class=""
                    >
                        <label for="" class="text-sm font-medium">
                            {{ categoryProperty.property_name }}
                        </label>
                        <select
                            v-if="
                                JSON.parse(categoryProperty.possible_values)
                                    .length > 0
                            "
                            class="block py-1 w-full"
                            @change="addProperties"
                        >
                            <option value="" disabled selected
                                >Select your option</option
                            >
                            <option
                                v-for="property_value in JSON.parse(
                                    categoryProperty.possible_values
                                )"
                                :key="property_value.id"
                                :value="[
                                    categoryProperty.property_name,
                                    categoryProperty.property_icon,
                                    property_value.value,
                                    categoryProperty.property_unit
                                ]"
                            >
                                {{
                                    property_value.value +
                                        " " +
                                        categoryProperty.property_unit
                                }}
                            </option>
                        </select>
                        <input
                            v-else
                            @input="
                                addTextProperty(
                                    $event,
                                    categoryProperty.property_name,
                                    categoryProperty.property_icon,
                                    categoryProperty.property_unit
                                )
                            "
                            type="text"
                            class="block py-1 w-full"
                        />
                    </div>
                </section>
            </div>

            <div class="mt-3">
                <label for="" class="text-sm font-medium"
                    >{{ __("Heading") }}
                </label>
                <input
                    type="text"
                    v-model="form.heading"
                    class="block py-3 md:py-1 w-full rounded md:w-4/6 border-gray-400"
                />
                <p class="text-red-500" v-if="errors.heading">
                    {{ errors.heading }}
                </p>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">
                    {{ __("Text") }}
                </label>
                <vue-editor
                    class="border-gray-400 block py-3 md:py-1 w-full rounded md:w-4/6"
                    v-model="form.text"
                    :editorToolbar="customToolbar"
                ></vue-editor>
                <p class="text-red-500" v-if="errors.text">
                    {{ errors.text }}
                </p>
            </div>
            <div class="mt-3">
                <label for="" class="text-sm font-medium">
                    {{ __("Price") }}
                </label>
                <div class="flex justify-items-start input-group">
                    <input
                        type="number"
                        class="border-gray-400"
                        v-model="form.price"
                    />
                    <p class="self-center p-3 text-sm border border-gray-400">
                        IQD
                    </p>
                </div>
                <p class="text-red-500" v-if="errors.price">
                    {{ errors.price }}
                </p>
            </div>

            <!-- images -->
            <div class="my-10">
                <div
                    class="md:flex md:justify-start grid grid-cols-3 md:space-s-2 gap-2"
                >
                    <div class="relative">
                        <div
                            v-if="previewImages[0]"
                            @click="cancelImage1"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input1">
                            <img
                                v-if="previewImages[0]"
                                :src="previewImages[0]"
                                alt=""
                                class="border border-gray-400 w-28 h-20"
                            />
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input1"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image1"
                        />
                    </div>
                    <div class="relative">
                        <div
                            v-if="previewImages[1]"
                            @click="cancelImage2"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input2">
                            <img
                                v-if="previewImages[1]"
                                :src="previewImages[1]"
                                alt=""
                                class="border border-gray-400 w-28 h-20"
                            />
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input2"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image2"
                        />
                    </div>
                    <div class="relative">
                        <div
                            v-if="previewImages[2]"
                            @click="cancelImage3"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input3">
                            <img
                                v-if="previewImages[2]"
                                :src="previewImages[2]"
                                alt=""
                                class="border border-gray-400 w-28 h-20"
                            />
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input3"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image3"
                        />
                    </div>
                    <div class="relative">
                        <div
                            v-if="previewImages[3]"
                            @click="cancelImage4"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input4">
                            <img
                                v-if="previewImages[3]"
                                :src="previewImages[3]"
                                alt=""
                                class="border border-gray-400 w-28 h-20"
                            />
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input4"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image4"
                        />
                    </div>
                    <div class="relative">
                        <div
                            v-if="previewImages[4]"
                            @click="cancelImage5"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input5">
                            <img
                                v-if="previewImages[4]"
                                :src="previewImages[4]"
                                alt=""
                                class="border border-gray-400 w-28 h-20"
                            />
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input5"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image5"
                        />
                    </div>
                    <div class="relative">
                        <div
                            v-if="previewImages[5]"
                            @click="cancelImage6"
                            class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
                        >
                            <i class="fas fa-times"></i>
                        </div>
                        <label for="file-input6">
                            <div class="relative" v-if="previewImages[5]">
                                <img
                                    :src="previewImages[5]"
                                    class="border border-gray-400 w-28 h-20"
                                />
                            </div>
                            <img
                                v-else
                                src="/media/site/camera.svg"
                                alt=""
                                class="border border-gray-400 px-8 py-6"
                            />
                        </label>
                        <input
                            id="file-input6"
                            type="file"
                            class="file hidden"
                            data-preview-file-type="text"
                            ref="photo"
                            @change="image6"
                        />
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="text-sm font-medium mb-2">
                    {{ __("Accept terms and conditions") }}
                </div>
                <label for="" class="text-sm">
                    <input
                        type="checkbox"
                        class="w-3 h-3 focus:ring-0 cursor-pointer"
                        v-model="form.terms"
                    />
                    {{ __("Yes, I accept Yallasell's") }}
                    <inertia-link href="/terms-of-use" class="underline"
                        >{{ __("terms of use") }}.</inertia-link
                    >
                </label>
                <p class="text-red-500 text-sm" v-if="terms">
                    * {{ __("accept terms to proceed.") }}
                </p>
            </div>
            <!-- <div
                class="md:space-s-8 mt-6 text-sm text-center md:text-left space-y-4 md:space-y-0"
            > -->
            <div
                class="md:flex md:justify-between mt-6 text-sm md:w-max text-center md:space-s-3 space-y-2 md:space-y-0 mb-10"
            >
                <div
                    href="#!"
                    class="cursor-pointer text-primary border border-gray-300 rounded-sm py-2 px-14 block md:inline-block"
                    @click="isHidden = !isHidden"
                >
                    {{ __("Preview ad") }}
                </div>
                <button
                    type="submit"
                    class="block w-full md:w-max md:inline-block text-white border border-1 bg-bg4 px-14 py-2 rounded"
                >
                    {{ __("Place an ad") }}
                </button>
            </div>
            <!-- <section class="mt-6">
                <inertia-link
                    href="/cookies"
                    class="text-xs font-light text-gray-800"
                >
                    {{ __("Cookie Policy") }}
                </inertia-link>
            </section> -->
        </form>

        <preview-modal
            v-if="!isHidden"
            v-on:click="isHidden = $event"
            :mainPreview="mainPreview"
            :previewImages="previewImages"
            :form="form"
        />
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import PreviewModal from "@/Components/PreviewModal";
import HeaderVue from "@/Components/Header";
export default {
    components: {
        VueEditor,
        PreviewModal,
        HeaderVue
    },
    props: [
        "user",
        "categories",
        "cities",
        "regions",
        "errors",
        "category_id",
        "language"
    ],
    data: function() {
        return {
            customToolbar: [
                [{ size: ["small", false, "large"] }],
                [{ header: 5 }, { header: 6 }],
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
                [{ direction: "rtl" }]
            ],

            isHidden: true,

            form: {
                is_individual: 1,
                user_id: this.user.id,
                name: this.user.name,
                email: this.user.email,
                phone: null,
                hidePhoneInAd: true,
                category_id: "",
                reason: "for-sale",
                price: null,

                zipcode: null,

                city_id: null,
                region_id: null,

                images: [],

                image1: null,
                image2: null,
                image3: null,
                image4: null,
                image5: null,
                image6: null,

                heading: null,
                text: null,
                payment: null,

                // Car
                registration_no: null,
                model_year: "",
                mileage: "",
                body_type: "",
                gearbox: "",
                fuel: "",

                terms: false,
                postProperties: {}
            },
            image: null,
            previewImages: [null, null, null, null, null, null],

            mainPreview: null,

            previewImage1: null,
            previewImage2: null,
            previewImage3: null,
            previewImage4: null,
            previewImage5: null,
            previewImage6: null,

            categoryProperties: [],
            possible_values: [],
            terms: false
        };
    },
    created() {
        this.form.category_id = this.category_id;
        this.getCatProperties();
        var unpaidpost = JSON.parse(localStorage.getItem("unpaidpost"));
        if (unpaidpost) {
            this.form.category_id = unpaidpost.category_id;
            this.form.city_id = unpaidpost.city_id;
            this.form.text = unpaidpost.detail;
            this.form.price = unpaidpost.expected_price;
            this.form.hidePhoneInAd = unpaidpost.hidePhoneInAd;
            this.form.is_individual = unpaidpost.is_individual;
            this.form.name = unpaidpost.name;
            this.form.payment = unpaidpost.payment;
            this.form.phone = unpaidpost.phone;
            this.form.reason = unpaidpost.reason;
            this.form.region_id = unpaidpost.region_id;
            this.form.status = unpaidpost.status;
            this.form.heading = unpaidpost.title;
            this.form.user_id = unpaidpost.user_id;
            this.form.zipcode = unpaidpost.zipcode;
        }
    },
    watch: {
        "form.category_id"() {
            this.getCatProperties();
            this.form.postProperties = {};
        }
    },
    methods: {
        getCatProperties() {
            axios
                .get("/api/v1/category-properties/" + this.form.category_id)
                .then(response => (this.categoryProperties = response.data));
        },
        addTextProperty(e, name, icon, unit) {
            this.form.postProperties[name] = {
                icon: icon,
                value: e.target.value,
                unit: unit
            };
        },
        addProperties(e) {
            var data = e.target.value.split(",");
            var name = data[0];
            this.form.postProperties[name] = {
                icon: data[1],
                value: data[2],
                unit: data[3]
            };
        },
        image1: function(e) {
            this.form.image1 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image1);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },
        image2: function(e) {
            this.form.image2 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image2);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },
        image3: function(e) {
            this.form.image3 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image3);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },
        image4: function(e) {
            this.form.image4 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image4);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },
        image5: function(e) {
            this.form.image5 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image5);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },
        image6: function(e) {
            this.form.image6 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.form.image6);
            reader.onload = e => {
                this.previewImages.pop();
                this.previewImages.unshift(e.target.result);
            };
        },

        cancelImage1: function(e) {
            this.form.image1 = null;
            this.previewImages.splice(0, 1);
            this.previewImages.push(null);
        },
        cancelImage2: function(e) {
            this.form.image2 = null;
            this.previewImages.splice(1, 1);
            this.previewImages.push(null);
        },
        cancelImage3: function(e) {
            this.form.image3 = null;
            this.previewImages.splice(2, 1);
            this.previewImages.push(null);
        },
        cancelImage4: function(e) {
            this.form.image4 = null;
            this.previewImages.splice(3, 1);
            this.previewImages.push(null);
        },
        cancelImage5: function(e) {
            this.form.image5 = null;
            this.previewImages.splice(4, 1);
            this.previewImages.push(null);
        },
        cancelImage6: function(e) {
            this.form.image6 = null;
            this.previewImages.splice(5, 1);
            this.previewImages.push(null);
        },

        images: function(e) {
            this.image = e.target.files[0];
            this.form.images.push(this.image);

            const reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.previewImages.push(e.target.result);
            };
        },
        submit() {
            localStorage.setItem("unpaidpost", null);
            var data = new FormData();
            data.append("is_individual", this.form.is_individual || "");
            data.append("user_id", this.form.user_id || "");
            data.append("name", this.form.name || "");
            data.append("email", this.form.email || "");
            data.append("phone", this.form.phone || "");
            data.append("hidePhoneInAd", this.form.hidePhoneInAd || "");
            data.append("category_id", this.form.category_id || "");
            data.append("reason", this.form.reason || "");
            data.append("price", this.form.price || "");
            data.append("zipcode", this.form.zipcode || "");
            data.append("city_id", this.form.city_id || "");
            data.append("region_id", this.form.region_id || "");
            data.append("image1", this.form.image1 || "");
            data.append("image2", this.form.image2 || "");
            data.append("image3", this.form.image3 || "");
            data.append("image4", this.form.image4 || "");
            data.append("image5", this.form.image5 || "");
            data.append("image6", this.form.image6 || "");
            data.append("heading", this.form.heading || "");
            data.append("text", this.form.text || "");
            data.append("terms", this.form.terms);
            data.append("payment", this.form.imagpaymentes || "");
            data.append(
                "postProperties",
                JSON.stringify(this.form.postProperties) || ""
            );
            if (this.form.terms == true) {
                this.$inertia.post("/post", data);
            } else {
                this.terms = true;
            }
            //   this.$inertia.post("/advert", this.form);
        }
    }
};
</script>

<style scoped>
.readonly {
    background-color: #f6f6f6;
    border: 1px solid #cccccc;
    cursor: not-allowed;
}

select {
    background: rgb(255, 255, 255);
    background: linear-gradient(
        180deg,
        rgba(255, 255, 255, 1) 0%,
        rgba(238, 238, 238, 1) 80%
    );
}

.input-group p {
    background-color: #eeeeee;
}

#previewModal {
    background-color: #2120207a;
}

input {
    box-shadow: var(--tw-ring-inset) 0 0 0
        calc(0px + var(--tw-ring-offset-width)) var(--tw-ring-color);
}
</style>
