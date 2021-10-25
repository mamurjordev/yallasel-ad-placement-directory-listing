<template>
    <div class="flex flex-wrap">
        <inertia-link
            href="/panel/user"
            class="w-full lg:w-6/12 xl:w-3/12 px-4"
        >
            <div
                class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div
                            class="relative w-full pr-4 max-w-full flex-grow flex-1"
                        >
                            <h5
                                class="text-gray-500 uppercase font-bold text-xs"
                            >
                                Users
                            </h5>
                            <span class="font-semibold text-xl text-gray-800">
                                {{ userCount }}
                            </span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                            >
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </inertia-link>
        <inertia-link
            href="/panel/post"
            class="w-full lg:w-6/12 xl:w-3/12 px-4"
        >
            <div
                class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                        <div
                            class="relative w-full pr-4 max-w-full flex-grow flex-1"
                        >
                            <h5
                                class="text-gray-500 uppercase font-bold text-xs"
                            >
                                Advertise
                            </h5>
                            <span class="font-semibold text-xl text-gray-800">
                                {{ postCount }}
                            </span>
                        </div>
                        <div class="relative w-auto pl-4 flex-initial">
                            <div
                                class="text-red-500 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                            >
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>
export default {
    props: ["userCount", "postCount", "articleviews"]
};
</script>
