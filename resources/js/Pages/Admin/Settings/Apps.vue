<template>
    <admin-layout>
        <div class="w-full md:px-4">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0"
            >
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">
                        <h6 class="text-gray-800 text-xl font-bold capitalize">
                            Apps Settings
                        </h6>
                    </div>
                </div>
                <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                    <form
                        @submit.prevent="submit"
                        enctype="multipart/form-data"
                    >
                        <h6
                            class="text-gray-500 text-sm my-3 font-bold uppercase"
                        >
                            Apps Information
                        </h6>
                        <p
                            v-if="success"
                            class="text-green-600 font-medium py-2"
                        >
                            {{ success }}
                        </p>
                        <div class="flex flex-wrap">
                            <div class="w-full md:px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password"
                                    >
                                        Android Playstore URL:
                                    </label>
                                    <input
                                        type="url"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        v-model="form.android_app"
                                    />
                                    <p
                                        class="text-red-500"
                                        v-if="errors.android_app"
                                    >
                                        {{ errors.android_app }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-full md:px-4">
                                <div class="relative w-full mb-3">
                                    <label
                                        class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password"
                                    >
                                        iOS AppStore URL:
                                    </label>
                                    <input
                                        type="url"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                        v-model="form.ios_app"
                                    />
                                    <p
                                        class="text-red-500"
                                        v-if="errors.ios_app"
                                    >
                                        {{ errors.ios_app }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button
                            class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-sm mt-4 mx-4 px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="submit"
                            :disabled="processing"
                        >
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    props: ["errors", "setting"],
    components: {
        AdminLayout
    },
    data() {
        return {
            form: {
                _method: "put",
                android_app: "",
                ios_app: ""
            },
            processing: false
        };
    },
    created() {
        this.form.android_app = this.setting.android_app;
        this.form.ios_app = this.setting.ios_app;
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            this.processing = true;
            this.$inertia.post("/panel/setting/apps", this.form);
            this.processing = false;
        }
    }
};
</script>
