<template>
    <div class="p-5">
        <h1 class="font-semibold">General Settings</h1>
        <div v-if="success" class="text-green-600 font-semibold ms-28 mt-2">
            {{ success }}
        </div>
        <form @submit.prevent="submit" class="my-5">
            <div class="flex items-center gap-3">
                <label for="title" class="text-sm font-semibold w-28"
                    >Site title:</label
                >
                <input
                    id="title"
                    v-model="form.site_title"
                    type="text"
                    class="py-1 rounded w-full"
                />
            </div>
            <div class="flex flex-wrap gap-5 ms-28 my-5">
                <div>
                    <label
                        class="relative w-60 h-52 bg-no-repeat bg-center bg-contain bg-blend-multiply flex flex-col justify-center items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-400 hover:text-white overflow-hidden"
                        :style="
                            'background-image: url(\'' + preview.logo + '\')'
                        "
                    >
                        <div
                            class="absolute opacity-30 top-0 start-0 bg-gray-400 w-60 h-52 flex items-center"
                        >
                            <!-- <img
                            :src="preview.logo"
                            alt=""
                            class="w-full max-h-full"
                        /> -->
                        </div>
                        <svg
                            class="w-8 h-8 z-20"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                            />
                        </svg>
                        <span class="mt-2 text-base leading-normal z-20"
                            >Select Logo</span
                        >
                        <input type="file" @change="logo" class="hidden" />
                    </label>
                    <p class="text-center font-semibold">Main Logo</p>
                </div>
                <div class="">
                    <label
                        class="relative w-60 h-52 bg-no-repeat bg-center bg-contain flex flex-col justify-center items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-400 hover:text-white overflow-hidden"
                        :style="
                            'background-image: url(\'' +
                                preview.mobilelogo +
                                '\')'
                        "
                    >
                        <div
                            class="absolute opacity-30 top-0 start-0 bg-gray-400 w-60 h-52 flex items-center"
                        >
                            <!-- <img
                            :src="preview.mobilelogo"
                            alt=""
                            class="w-60 max-h-full"
                        /> -->
                        </div>
                        <svg
                            class="w-8 h-8 z-20"
                            fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                            />
                        </svg>
                        <span class="mt-2 text-base leading-normal z-20"
                            >Select Mobile Logo</span
                        >
                        <input
                            type="file"
                            @change="mobilelogo"
                            class="hidden"
                        />
                    </label>
                    <p class="text-center font-semibold">Mobile Logo</p>
                </div>
            </div>
            <button
                type="submit"
                class="bg-blue-500 text-white rounded px-10 py-2 ms-28 mt-5 hover:shadow-xl"
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
                site_title: "",
                site_logo: null,
                site_mobile_logo: null
            },
            preview: {
                logo: null,
                mobilelogo: null
            }
        };
    },
    mounted() {
        if (this.setting) {
            this.form.site_title = this.setting.site_title;
            this.preview.logo = "/media/site/" + this.setting.site_logo;
            this.preview.mobilelogo =
                "/media/site/" + this.setting.site_mobile_logo;
        }
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        async submit() {
            var _this = this;
            await this.$inertia.post("/panel/setting/update", this.form);
            setTimeout(function() {
                _this.$page.props.flash.success = null;
            }, 3500);
        },
        logo(e) {
            this.form.site_logo = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = e => {
                this.preview.logo = e.target.result;
            };
        },
        mobilelogo(e) {
            this.form.site_mobile_logo = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = e => {
                this.preview.mobilelogo = e.target.result;
            };
        }
    }
};
</script>
