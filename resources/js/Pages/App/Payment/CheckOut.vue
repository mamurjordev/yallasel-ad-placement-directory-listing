<template>
    <app-layout>
        <div class="container mx-auto py-10">
            <div class="text-center font-semibold text-2xl mb-4">
                {{ __("Payment") }}
            </div>
            <div v-if="success" class="">
                <a
                    href="#"
                    class="close"
                    data-dismiss="alert"
                    aria-label="close"
                    >×</a
                >
                <p>{{ success }}</p>
            </div>

            <form
                @submit.prevent="submit"
                data-cc-on-file="false"
                class="p-4 md:w-1/2 mx-auto bg-white rounded space-y-4"
            >
                <div class="w-full">
                    <label class="">Name on Card</label>
                    <input class="w-full" size="4" type="text" />
                </div>
                <div class="w-full">
                    <label class="">Card Number</label>
                    <input
                        autocomplete="off"
                        class="w-full"
                        size="20"
                        type="text"
                    />
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="">
                        <label class="">CVC</label>
                        <input
                            autocomplete="off"
                            class="w-full"
                            placeholder="e.g 415"
                            size="4"
                            type="text"
                        />
                    </div>
                    <div class="">
                        <label class="">Expiration Month</label>
                        <input
                            class="w-full"
                            placeholder="MM"
                            size="2"
                            type="text"
                        />
                    </div>
                    <div class="">
                        <label class="">Expiration Year</label>
                        <input
                            class="w-full"
                            placeholder="YYYY"
                            size="4"
                            type="text"
                        />
                    </div>
                </div>

                <!-- <div class="form-row row">
                    <div class="col-md-12 hide error form-group">
                        <div class="alert-danger alert">
                            Fix the errors before you begin.
                        </div>
                    </div>
                </div> -->
                <button
                    class="bg-green-500 text-white w-full rounded py-2 my-6 font-medium"
                    type="submit"
                >
                    Pay Now (100 IQD)
                </button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    data() {
        return {
            form: {
                cardname: "",
                cardnumber: "",
                cvc: "",
                expMonth: "",
                expYear: ""
            }
        };
    },
    components: {
        AppLayout
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    },
    methods: {
        submit() {
            this.$inertia.post("/stripe-payment");
        }
    },
    mounted() {
        $(function() {
            var $form = $(".require-validation");
            $("form.require-validation").bind("submit", function(e) {
                var $form = $(".require-validation"),
                    inputSelector = [
                        "input[type=email]",
                        "input[type=password]",
                        "input[type=text]",
                        "input[type=file]",
                        "textarea"
                    ].join(", "),
                    $inputs = $form.find(".required").find(inputSelector),
                    $errorMessage = $form.find("div.error"),
                    valid = true;
                $errorMessage.addClass("hide");

                $(".has-error").removeClass("has-error");
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === "") {
                        $input.parent().addClass("has-error");
                        $errorMessage.removeClass("hide");
                        e.preventDefault();
                    }
                });

                if (!$form.data("cc-on-file")) {
                    e.preventDefault();
                    Stripe.setPublishableKey(
                        $form.data("stripe-publishable-key")
                    );
                    Stripe.createToken(
                        {
                            number: $(".card-number").val(),
                            cvc: $(".card-cvc").val(),
                            exp_month: $(".card-expiry-month").val(),
                            exp_year: $(".card-expiry-year").val()
                        },
                        stripeResponseHandler
                    );
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $(".error")
                        .removeClass("hide")
                        .find(".alert")
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response["id"];
                    // insert the token into the form so it gets submitted to the server
                    $form.find("input[type=text]").empty();
                    $form.append(
                        "<input type='hidden' name='stripeToken' value='" +
                            token +
                            "'/>"
                    );
                    $form.get(0).submit();
                }
            }
        });
    }
};
</script>
