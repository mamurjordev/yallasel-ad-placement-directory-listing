<template>
    <app-layout>
        <div class="bg-gray-50 py-6">
            <div
                v-if="success"
                class="text-green-600 font-semibold container mx-auto px-3 bg-green-100 py-1 border border-green-900"
            >
                {{ __("Account updated successfully") }}
            </div>
            <form
                @submit.prevent="submit"
                class="container mx-auto bg-white p-2 md:p-5 border border-gray-300 flex flex-col space-y-3"
            >
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <label for="">{{ __("Profile Image") }}</label>
                        <input type="file" @change="profile" />
                    </div>
                    <img :src="previewImage" class="w-24 h-24" />
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Name") }}</label>
                    <input type="text" v-model="form.name" />
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Username") }}</label>
                    <input type="text" v-model="form.username" />
                    <p
                        v-if="errors.username"
                        class="text-red-600 text-sm font-semibold"
                    >
                        {{ errors.username }}
                    </p>
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Appears in ads") }}</label>
                    <select v-model="form.is_privacy_enabled">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("ZIP code") }}</label>
                    <input type="text" v-model="form.zip" />
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Mobile") }}</label>
                    <input type="text" v-model="form.mobile" />
                    <p
                        v-if="errors.mobile"
                        class="text-red-600 text-sm font-semibold"
                    >
                        {{ errors.mobile }}
                    </p>
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Email") }}</label>
                    <input type="text" v-model="form.email" readonly />
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Shop Banner Image") }}</label>
                    <input type="file" @change="image" />
                </div>
                <div class="flex flex-col">
                    <label for="">{{ __("Shop Description") }}</label>
                    <vue-editor
                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                        v-model="form.shop_desc"
                        :editorToolbar="customToolbar"
                    ></vue-editor>
                </div>
                <div class="w-full text-center">
                    <button
                        type="submit"
                        class="bg-green-500 py-1 uppercase font-semibold rounded px-5 hover:shadow-xl"
                    >
                        {{ __("submit") }}
                    </button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import { usersRef } from "@/firestore";
import AppLayout from "@/Layouts/AppLayout";
import { VueEditor } from "vue2-editor";
export default {
    props: ["user", "account_settting", "errors"],
    data() {
        return {
            form: {
                name: this.user.name,
                is_privacy_enabled: this.user.is_privacy_enabled,
                zip: this.user.zip,
                mobile: this.user.mobile,
                email: this.user.email,
                shop_banner: null,
                shop_desc: this.account_settting.shop_desc,
                username: this.user.username,
                profile: null
            },
            previewImage: null,
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
    components: {
        AppLayout,
        VueEditor
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            this.$inertia.post("/account/setting", this.form);
        },
        image: function(e) {
            this.form.shop_banner = e.target.files[0];
        },
        profile(e) {
            this.form.profile = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = e => {
                this.previewImage = e.target.result;
            };
        },
        updateFirebase() {
            usersRef.doc("" + this.user.id).update({
                username: this.user.username,
                avatar: this.user.profile_photo
            });
        }
    },
    created() {
        this.updateFirebase();
        this.previewImage =
            "/media/user/" + (this.user.profile_photo ?? "default.svg");
        if (this.account_settting) {
            this.form.shop_desc = this.account_settting.shop_desc;
        }
    },
    mounted() {
        this.updateFirebase();
    }
};
</script>
