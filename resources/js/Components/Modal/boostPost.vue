<template>
    <div
        class="fixed z-10 inset-0 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                aria-hidden="true"
            ></div>
            <!-- <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            > -->
            <div
                class="relative inline-block align-bottom text-gray-700 bg-white rounded text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <img
                    src="/media/vip-card.svg"
                    class="absolute top-0 start-0 w-14 h-14"
                />
                <div class="bg-blue-300 h-20 w-full p-2">
                    <div
                        @click="closeModal"
                        class="text-red-700 text-end cursor-pointer text-lg"
                    >
                        <i class="far fa-times-circle"></i>
                    </div>
                    <h1
                        class="text-center font-extrabold text-gray-900 uppercase"
                    >
                        -{{ __("Boost this ad") }}-
                    </h1>
                </div>
                <svg
                    data-name="Layer 1"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1200 120"
                    preserveAspectRatio="none"
                    fill="#90c5f9"
                >
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"
                    ></path>
                </svg>
                <div class="p-5 flex flex-col gap-4">
                    <h1 class="font-semibold">{{ post.title }}</h1>
                    <div
                        v-if="hasBoost"
                        class="text-sm font-medium text-green-700"
                    >
                        {{ __("Boosted till") }}
                        <span class="font-bold text-green-800">{{
                            post.boost_until | moment("DD MMM YYYY")
                        }}</span>
                    </div>
                    <form
                        @submit.prevent="submit"
                        class="flex flex-col items-center"
                    >
                        <label class="font-semibold mb-2"
                            >{{ __("Add week") }}:</label
                        >
                        <input
                            type="number"
                            v-model="form.week"
                            class="border-gray-400 font-bold text-xl py-1 text-center focus:ring-0 focus:border-gray-400"
                        />
                        <button
                            class="bg-blue-500 text-white font-semibold uppercase px-10 py-1 my-3 shadow-xl hover:shadow-sm"
                        >
                            {{ __("Add") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment-timezone";
export default {
    props: ["post"],
    data() {
        return {
            form: {
                week: 1,
                post_id: this.post.id
            }
        };
    },
    computed: {
        hasBoost() {
            var boost = this.post.boost_until;
            if (moment(boost) > moment()) {
                return true;
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit("closeModal");
        },
        submit() {
            axios
                .post("/boost-post", this.form)
                .then(response => window.location.replace(response.data));
        }
    }
};
</script>
