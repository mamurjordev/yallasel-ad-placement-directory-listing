<template>
    <admin-layout>
        <div
            class="relative grid grid-cols-1 lg:grid-cols-7 lg:gap-3 min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-200 border-0 mx-4 p-5"
        >
            <div class="w-full">
                <h1 class="font-bold text-xl">Settings</h1>
                <ul class="flex flex-wrap text-sm font-semibold py-5 space-y-1">
                    <li
                        @click="use_component = 'General'"
                        class="bg-indigo-200 w-full py-2 px-3 border border-indigo-400 hover:bg-indigo-100 cursor-pointer"
                    >
                        General setting
                    </li>
                    <li
                        @click="use_component = 'Payment'"
                        class="bg-indigo-200 w-full py-2 px-3 border border-indigo-400 hover:bg-indigo-100 cursor-pointer"
                    >
                        Payment setting
                    </li>
                    <li
                        @click="use_component = 'Pricing'"
                        class="bg-indigo-200 w-full py-2 px-3 border border-indigo-400 hover:bg-indigo-100 cursor-pointer"
                    >
                        Pricing setting
                    </li>
                    <li
                        @click="use_component = 'Mail'"
                        class="bg-indigo-200 w-full py-2 px-3 border border-indigo-400 hover:bg-indigo-100 cursor-pointer"
                    >
                        Mail setting
                    </li>
                </ul>
            </div>
            <div class="col-span-6 bg-white rounded">
                <component
                    :is="use_component"
                    :setting="setting"
                    :payment="payment"
                    :mail="mail"
                ></component>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import General from "@/Components/Admin/Settings/General";
import Payment from "@/Components/Admin/Settings/Payment";
import Pricing from "@/Components/Admin/Settings/Pricing";
import Mail from "@/Components/Admin/Settings/Mail";
export default {
    props: ["setting", "payment", "mail"],
    components: {
        AdminLayout,
        General,
        Payment,
        Pricing,
        Mail
    },
    data() {
        return {
            use_component: "General"
        };
    },
    watch: {
        use_component() {
            this.$page.props.flash.success = null;
        }
    }
};
</script>
