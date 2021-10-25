<template>
    <app-layout>
        <div class="container mx-auto font-notosans py-10">
            <div class="text-5xl font-extrabold text-gray-800 pb-10">
                {{ __("Open a shop") }}
            </div>
            <div class="text-gray-900">
                <p>
                    {{
                        __(
                            "peed ​​up your sales and reach your customers easily and cost-effectively. Open a store on Blocket and display your products and your brand on Sweden's largest marketplace. Market your entire product range under one roof - gold mode for additional sales!"
                        )
                    }}
                </p>
                <p>
                    {{
                        __(
                            "The Blocket store includes a variety of features. Among other things, you get your own store page which includes advertising statistics so you can see what effect the ads give. More features can be found below."
                        )
                    }}
                </p>
            </div>
            <!-- Table -->
            <div class="my-10">
                <table class="table-fixed">
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __("Your store page on Blocket") }}</td>
                            <td>
                                {{
                                    __(
                                        "Give a professional impression, collect and manage your ads under one roof. With a unique link to your Blocket store."
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ __("Ad statistics") }}
                            </td>
                            <td>
                                {{
                                    __(
                                        "See how your ads in your store are performing"
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Multilän") }}</td>
                            <td>
                                {{
                                    __(
                                        "Make it easy to reach with the same ad in multiple counties"
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Website link") }}</td>
                            <td>
                                {{
                                    __(
                                        "Drive traffic to your own website. (Not for import)"
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Storefront") }}</td>
                            <td>
                                {{
                                    __(
                                        "Promote your latest ads in a separate display window on your item page. Shows only your store ads instead of competing ads."
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Logo in your objects") }}</td>
                            <td>
                                {{
                                    __(
                                        "Appear with your logo on Sweden's largest marketplace!"
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Search function in your store") }}</td>
                            <td>
                                {{
                                    __(
                                        "Make it easy for the customer to find your ads via the search function in your store."
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Extra pictures") }}</td>
                            <td>
                                {{ __("Get up to 10 images on each store ad") }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Easy payment") }}</td>
                            <td>
                                {{
                                    __(
                                        "Total invoice payment for your advertising on Blocket."
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Telephone support") }}</td>
                            <td>
                                {{
                                    __(
                                        "Get help from dedicated store support by phone or email."
                                    )
                                }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __("Optional products") }}</td>
                            <td>
                                {{
                                    __(
                                        "Opportunity to add additional services that increase your sales."
                                    )
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="pt-3">
                    {{ __("What conditions apply to opening a store?") }}
                    <inertia-link href="#!" class="text-primary underline"
                        >Here you will find rules and conditions</inertia-link
                    >
                    {{ __("for companies that want to advertise.") }}
                </p>
            </div>
            <!-- Form -->
            <div class="">
                <div class="font-semibold text-gray-900 text-3xl">
                    {{ __("I want to be contacted") }}
                </div>
                <form class="flex flex-col space-y-3 pt-3">
                    <label for=""
                        >{{ __("First and last name") }}
                        <span class="text-red-600">*</span></label
                    >
                    <input type="text" />
                    <label for=""
                        >{{ __("Company") }}
                        <span class="text-red-600">*</span></label
                    >
                    <input type="text" />
                    <label for=""
                        >{{ __("Email address") }}
                        <span class="text-red-600">*</span></label
                    >
                    <input type="email" />
                    <label for=""
                        >{{ __("Telephone number") }}
                        <span class="text-red-600">*</span></label
                    >
                    <input type="tel" v-model="form.phone" />
                    <label for="">{{ __("Org.nr") }}</label>
                    <input type="text" v-model="org_nr" />
                    <label for=""
                        >{{ __("Category") }}
                        <span class="text-red-600">*</span></label
                    >
                    <select v-model="form.category">
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            value="category.id"
                            >{{ category.category_name }}</option
                        >
                    </select>

                    <button
                        type="submit"
                        class="text-white bg-green-500 py-2 rounded font-medium text-lg"
                    >
                        {{ __("Contact me") }}
                    </button>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    props: ["categories"],
    components: {
        AppLayout
    },
    data() {
        return {
            form: {
                name: "",
                company: "",
                email: "",
                phone: "",
                org_nr: "",
                category: null
            }
        };
    }
};
</script>

<style scoped>
table tbody tr td {
    border: 1px solid rgb(209, 209, 209);
    padding: 8px;
}
table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
input {
    border-radius: 5px;
}
</style>
