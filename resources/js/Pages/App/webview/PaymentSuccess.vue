<template>
    <div
        class="flex flex-col gap-5 items-center justify-center container mx-auto mt-24 my-10"
    >
        <svg
            version="1.1"
            id="Capa_1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px"
            y="0px"
            viewBox="0 0 415.869 415.869"
            style="enable-background:new 0 0 415.869 415.869;"
            xml:space="preserve"
            class="w-10"
        >
            <path
                style="fill:#00BBD3;"
                d="M193.306,282.645L193.306,282.645c-4.702,0-8.882-2.09-11.494-5.224l-78.89-85.682
	c-5.747-6.269-5.224-16.196,1.045-21.943c6.269-5.747,16.196-5.224,21.943,1.045l67.918,73.665L381.91,56.947
	c6.269-6.269,16.196-6.269,21.943,0c5.747,6.269,6.269,16.196,0,21.943L204.278,277.943
	C201.665,281.078,197.486,282.645,193.306,282.645z"
            />
            <path
                style="fill:#3A2C51;"
                d="M207.935,415.869C93.518,415.869,0,322.351,0,207.935S93.518,0,207.935,0
	c8.882,0,15.673,6.792,15.673,15.673s-6.792,15.673-15.673,15.673c-97.176,0-176.588,79.412-176.588,176.588
	s79.412,176.588,176.588,176.588s176.588-79.412,176.588-176.588c0-8.882,6.792-15.673,15.673-15.673s15.673,6.792,15.673,15.673
	C415.869,322.351,322.351,415.869,207.935,415.869z"
            />
        </svg>
        <h1 class="font-bold text-green-700 text-xl">
            {{ __("your Payment was successful") }}
        </h1>
        <div class="text-center">
            <inertia-link
                href="/post-ad"
                class="font-semibold hover:underline text-blue-600"
                >{{ __("Place a post") }}</inertia-link
            >
            <div class="font-semibold">-{{ __("or") }}-</div>
            <inertia-link
                href="/"
                class="font-semibold hover:underline text-indigo-600"
                >{{ __("Go to home") }}</inertia-link
            >
        </div>
    </div>
</template>
