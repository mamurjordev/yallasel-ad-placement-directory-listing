<template>
    <section
            class="border border-solid border-gray-400 p-5 mt-6 flex overflow-hidden"
          >
            <div class="">
              <div class="text-lg font-medium mb-3">
                <span class="text-white bg-btn rounded-full px-2 py-1 me-2">{{
                  __("Novelty!")
                }}</span
                >{{ __("Buy safely with Yallasell Payment") }}
              </div>
              <div class="text-light text-gray-700">
                <i class="fas fa-check text-green-400 pe-2"></i>
                {{
                  __("Both buyers and sellers identify themselves with BankID")
                }}
              </div>
              <div class="text-light text-gray-700">
                <i class="fas fa-check text-green-400 pe-2"></i>
                {{
                  __(
                    "Choose how you want to pay - direct payment, free invoice or partial payment"
                  )
                }}
              </div>
              <div class="text-light text-gray-700">
                <i class="fas fa-check text-green-400 pe-2"></i>
                {{ __("The seller receives money directly to his account") }}
              </div>
              <div class="my-6">
                <a
                  href="#!"
                  class="border border-solid border-gray-400 rounded-md px-10 py-2"
                  >{{ __("Start Yallsell Payment") }}</a
                >
                <a href="#!" class="text-primary ps-3 block mt-3 md:inline">{{
                  __("Read more about the service")
                }}</a>
              </div>
              <div class="font-medium pb-1">
                {{ __("Check if you can use Yallasell Payment with invoice") }}
              </div>
              <p class="text-gray-800">
                Here you can see how much you can buy for via invoice with
                Blocketbetalning. If you want, you can take out a loan and split
                the payment over time.
                <a href="#!" class="text-primary">Check your credit space.</a>
              </p>
            </div>
            <div class="flex items-end -me-16 -mb-24">
              <img
                src="/media/site/carbuyers.svg   "
                alt=""
                class="h-64 -mb-2"
              />
            </div>
          </section>
</template>

<script>
export default {

}
</script>
