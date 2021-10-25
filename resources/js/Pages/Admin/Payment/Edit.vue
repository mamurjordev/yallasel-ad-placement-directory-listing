<template>
    <admin-layout>
        <div class="flex flex-wrap mt-4">
            <payment-package
                formName="Payment Package"
                :errors="errors"
                :paymentPackage="paymentPackage"
            ></payment-package>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import PaymentPackage from "@/Components/Admin/Forms/PaymentPackage";
export default {
    props: ["errors", "paymentPackage"],
    components: {
        AdminLayout,
        PaymentPackage
    }
};
</script>
