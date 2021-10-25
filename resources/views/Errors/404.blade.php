<template>
    <app-layout>
        <section class="container mx-auto text-center text-gray-700 py-16">
            <div class="w-full">
                <img class="mx-auto" src="/media/site/oops.png" alt="">
            </div>
            <div class="font-bold text-2xl mt-2">{{ __('Oops, 404 Error') }}</div>
            <p class="font-light my-3">{{ __('We could not find the page you were looking for') }}</p>
            <inertia-link href="/" class="text-primary">{{ __('Return back to Yallasell home') }}</inertia-link>
        </section>
    </app-layout>
</template>
