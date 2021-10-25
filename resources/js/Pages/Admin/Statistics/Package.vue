<template>
    <admin-layout>
        <div class="grid gap-3">
            <BarChart :count="packageSold" class="shadow-xl" />

            <div class="block bg-white shadow-xl mt-6 w-full overflow-x-auto">
                <!-- Projects table -->
                <h1 class="font-semibold px-3 py-2">Package selling details</h1>
                <table
                    class="items-center w-full bg-transparent border-collapse"
                >
                    <thead>
                        <tr>
                            <th
                                v-for="header in Headers"
                                :key="header"
                                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left bg-gray-100 text-gray-600 border-gray-200"
                            >
                                {{ header }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(content, index) in packageDetails.data"
                            :key="content.id"
                        >
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4 text-left flex items-center"
                            >
                                {{ index + 1 }}
                            </th>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{ content.name }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{ content.price }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{
                                    content.is_subscription == 0
                                        ? "FALSE"
                                        : "TRUE"
                                }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{
                                    value(
                                        content.is_subscription,
                                        content.subscription_length,
                                        content.time_period,
                                        content.post_amount
                                    )
                                }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{ content.feature == 0 ? "FALSE" : "TRUE" }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-no-wrap p-4"
                            >
                                {{ sold(content.sold) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Paginate -->
            <section>
                <nav
                    class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <div
                        v-for="link in packageDetails.links"
                        :key="link.id"
                        class=""
                    >
                        <inertia-link
                            v-if="link.url"
                            :href="link.url"
                            preserve-scroll
                            :class="
                                link.active
                                    ? 'bg-red-400 text-white'
                                    : 'text-gray-700 bg-white'
                            "
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50"
                        >
                            {{ link.label }}
                        </inertia-link>
                    </div>
                </nav>
            </section>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import BarChart from "@/Components/Admin/Chart/Bar2";
export default {
    props: ["packageSold", "packageDetails"],
    components: {
        AdminLayout,
        BarChart
    },
    data() {
        return {
            Headers: [
                "SR",
                "Plan Name",
                "Price",
                "Is subscription",
                "Value",
                "Is feature",
                "Sold"
            ]
        };
    },
    methods: {
        value(is_subscription, subscription_length, time_period, post_amount) {
            if (is_subscription == 1) {
                return subscription_length + " " + time_period;
            } else {
                return post_amount + " Posts";
            }
        },
        sold(solds) {
            var sold = 0;
            solds.forEach(element => {
                sold += element.amount;
            });
            return sold;
        }
    }
};
</script>
