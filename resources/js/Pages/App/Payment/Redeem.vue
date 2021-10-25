<template>
    <app-layout>
        <div class="container mx-auto h-full my-10">
            <h2 class="text-center font-semibold text-2xl">
                {{ __("Redeem your code") }}
            </h2>
            <div class="w-72 mx-auto self-center mt-10">
                <label>{{ __("Redeem code") }}</label>
                <input
                    type="text"
                    class="w-full rounded text-purple-600  border-b border-red-400"
                    v-model="code"
                />

                <div
                    @click="submit"
                    class="cursor-pointer bg-purple-500 w-full text-center text-white mt-3 py-1 rounded"
                >
                    {{ __("Redeem") }}
                </div>

                <div v-if="cancel" class="text-red-500 mt-4">{{ cancel }}</div>
                <div v-if="success" class="text-green-500 mt-4">
                    {{ success }}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout
    },
    data() {
        return {
            code: ""
        };
    },
    computed: {
        cancel() {
            return this.$page.props.errors.cancel;
        },
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            var data = {
                code: this.code
            };
            this.$inertia.post("/redeem_code/submit", data);
        }
    }
};
</script>
