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
                        :href="$route('panel.city.index')"
                        class="block float-right bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        preserve-scroll
                    >
                        {{ formName }} List
                    </inertia-link>
                </div>
            </div>
            <div class="flex-auto md:px-4 lg:px-10 py-10 pt-0">
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="flex flex-wrap mt-6">
                        <div class="w-1/2 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Region Name
                                </label>
                                <input
                                    type="text"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    v-model="form.region_name"
                                />
                                <p
                                    class="text-red-500"
                                    v-if="errors.region_name"
                                >
                                    {{ errors.region_name }}
                                </p>
                            </div>
                        </div>
                        <div class="w-1/2 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    Region name in Arabic
                                </label>
                                <input
                                    type="text"
                                    class="px-3 dir-rtl py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
                                    v-model="form.region_name_ar"
                                />
                                <p
                                    class="text-red-500"
                                    v-if="errors.region_name_ar"
                                >
                                    {{ errors.region_name_ar }}
                                </p>
                            </div>
                        </div>
                        <div class="w-1/2 md:px-4">
                            <div class="relative w-full mb-3">
                                <label
                                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                    htmlFor="grid-password"
                                >
                                    City
                                </label>
                                <select
                                    v-model="form.city_id"
                                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none w-full ease-linear transition-all duration-150"
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
                        </div>
                    </div>

                    <div class="flex flex-wrap">
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
export default {
    props: { formName: String, errors: Object, region: Object, cities: Array },
    data: function() {
        return {
            form: this.$inertia.form({
                _method: "post",
                region_name: "",
                region_name_ar: "",
                city_id: ""
            })
        };
    },
    methods: {
        submit() {
            var data = new FormData();
            data.append("region_name", this.form.region_name);
            data.append("region_name_ar", this.form.region_name_ar);
            data.append("city_id", this.form.city_id);

            if (this.region) {
                this.form.post(
                    this.route("panel.region.update", this.region.id)
                );
            } else {
                this.$inertia.post("/panel/region", data);
            }
        }
    },

    created() {
        if (this.region) {
            this.form._method = "put";
            this.form.region_name = this.region.region_name;
            this.form.region_name_ar = this.region.region_name_ar;
            this.form.city_id = this.region.city_id;
        }
    }
};
</script>

<style scoped>
.dir-rtl {
    unicode-bidi: bidi-override;
    direction: rtl;
}
</style>
