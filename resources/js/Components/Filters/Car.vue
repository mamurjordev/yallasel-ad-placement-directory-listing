<template>
    <div class="">
        <section class="hidden md:grid grid-cols-6 gap-3">
            <div class="flex flex-col gap-2">
                <label class="font-bold">{{ __("Price") }}</label>
                <select v-model="filter.min_price" class="rounded p-1">
                    <option value="">{{ __("From") }}</option>
                    <option
                        v-for="index in 20"
                        :key="index"
                        :value="5000 + (index - 1) * 5000"
                        >{{ 5000 + (index - 1) * 5000 }} iqd</option
                    >
                </select>
                <select v-model="filter.max_price" class="rounded p-1">
                    <option value="">{{ __("To") }}</option>
                    <option
                        v-for="index in 20"
                        :key="index"
                        :value="5000 + (index - 1) * 5000"
                        >{{ 5000 + (index - 1) * 5000 }} iqd</option
                    >
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-bold">{{ __("Model year") }}</label>
                <select v-model="filter.my_from" class="rounded p-1">
                    <option value="">{{ __("From") }}</option>
                    <option
                        v-for="index in currentYear - 1980 + 1"
                        :key="index"
                        :value="currentYear - (index - 1)"
                        >{{ currentYear - (index - 1) }}</option
                    >
                    <option value="1970">70s</option>
                    <option value="1960">60s</option>
                    <option value="1950">50s</option>
                    <option value="1940">40s</option>
                    <option value="1830">30s and older</option>
                </select>
                <select v-model="filter.my_to" class="rounded p-1">
                    <option value="">{{ __("To") }}</option>
                    <option
                        v-for="index in currentYear - 1980 + 1"
                        :key="index"
                        :value="currentYear - (index - 1)"
                        >{{ currentYear - (index - 1) }}</option
                    >
                    <option value="1970">70s</option>
                    <option value="1960">60s</option>
                    <option value="1950">50s</option>
                    <option value="1940">40s</option>
                    <option value="1830">30s and older</option>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-bold">{{ __("Mileage") }}</label>
                <select v-model="filter.mileage_from" class="rounded p-1">
                    <option value="">{{ __("From") }}</option>
                    <option
                        v-for="index in 20"
                        :key="index"
                        :value="500 + (index - 1) * 500"
                        >{{ 500 + (index - 1) * 500 }}</option
                    >
                    <option
                        v-for="index in 10"
                        :key="'A' + index"
                        :value="11000 + (index - 1) * 1000"
                        >{{ 11000 + (index - 1) * 1000 }}</option
                    >
                    <option
                        v-for="index in 6"
                        :key="'B' + index"
                        :value="25000 + (index - 1) * 5000"
                        >{{ 25000 + (index - 1) * 5000 }}</option
                    >
                </select>
                <select v-model="filter.mileage_to" class="rounded p-1">
                    <option value="">{{ __("To") }}</option>
                    <option
                        v-for="index in 20"
                        :key="index"
                        :value="500 + (index - 1) * 500"
                        >{{ 500 + (index - 1) * 500 }}</option
                    >
                    <option
                        v-for="index in 10"
                        :key="'A' + index"
                        :value="11000 + (index - 1) * 1000"
                        >{{ 11000 + (index - 1) * 1000 }}</option
                    >
                    <option
                        v-for="index in 6"
                        :key="'B' + index"
                        :value="25000 + (index - 1) * 5000"
                        >{{ 25000 + (index - 1) * 5000 }}</option
                    >
                </select>
            </div>
            <div class="flex flex-col gap-2" v-if="fuels">
                <label class="font-bold">{{ __("Fuel") }}</label>
                <select v-model="filter.fuel" class="rounded p-1 capitalize">
                    <option value="">{{ __("All") }}</option>
                    <option
                        v-for="(fuel, index) in fuels"
                        :key="index"
                        :value="fuel.value"
                        >{{ fuel.value }}</option
                    >
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-bold">{{ __("Gearbox") }}</label>
                <select v-model="filter.gearbox" class="rounded p-1 capitalize">
                    <option value="">{{ __("All") }}</option>
                    <option
                        v-for="(gearbox, index) in gearboxes"
                        :key="index"
                        :value="gearbox.value"
                        >{{ gearbox.value }}</option
                    >
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="font-bold">{{ __("Horsepower") }}</label>
                <select v-model="filter.hp_from" class="rounded p-1">
                    <option value="">{{ __("From") }}</option>
                    <option
                        v-for="index in 14"
                        :key="index"
                        :value="40 + (index - 1) * 20"
                        >{{ 40 + (index - 1) * 20 }}</option
                    >
                    <option
                        v-for="index in 4"
                        :key="'A' + index"
                        :value="350 + (index - 1) * 50"
                        >{{ 350 + (index - 1) * 50 }}</option
                    >
                </select>
                <select v-model="filter.hp_to" class="rounded p-1">
                    <option value="">{{ __("To") }}</option>
                    <option
                        v-for="index in 14"
                        :key="index"
                        :value="40 + (index - 1) * 20"
                        >{{ 40 + (index - 1) * 20 }}</option
                    >
                    <option
                        v-for="index in 4"
                        :key="'A' + index"
                        :value="350 + (index - 1) * 50"
                        >{{ 350 + (index - 1) * 50 }}</option
                    >
                </select>
            </div>
        </section>
        <section
            class="flex flex-col md:flex-row justify-between mt-10 items-center gap-5 md:gap-10"
        >
            <div
                class="text-xs tracking-wider grid grid-cols-5 md:grid-cols-9 gap-3"
            >
                <button
                    :class="
                        filter.car_type.includes('small')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    @click="toggleCarType('small')"
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('small') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconSmallCar_svg__a"
                                d="M.198 19.956c.09.392.306.374.306.374h.683c.341 0 .287-.392.287-.392a5.674 5.674 0 013.236-4.796 5.6 5.6 0 012.516-.57c3.164 0 5.752 2.549 5.752 5.704v.963s-.036.482.468.482h25.093c.467 0 .431-.446.431-.446l-.018-1.284c.144-3.013 2.66-5.42 5.734-5.42 2.085 0 3.9 1.088 4.907 2.728v.018c.522.856.701 1.8.701 2.888v1.034s-.036.428.414.428l2.39-.553c.845-.285.845-.998.845-.998v-2.674c0-.642-.413-.803-.413-.803 0-1.337-.809-2.068-.809-2.068s-.09-1.337-1.168-2.442a4.707 4.707 0 00-1.402-.963c-3.811-2.603-8.628-2.264-8.628-2.264C37.693 4.088 30.827.682 25.525.13 20.24-.423 8.682.968 8.682.968c-.7 0-.162.695-.162.695l.288.392S5.986 3.785 3.865 9.83c-.557-.143-1.133.392-1.977 1.55-.827 1.16-.701 1.873-.701 1.873-.144 0-.486.018-.683.232-.252.214-.27.57-.27.57a20.283 20.283 0 00-.036 5.902zM37.155 8.42l-16.7-.428s-.377-.017-.377-.356l-.072-5.295c0-.321.378-.321.378-.321a57.642 57.642 0 013.397-.107c.899 0 1.69.035 2.319.089 2.067.214 4.548 1.016 6.866 2.246 1.744.927 3.416 2.122 4.764 3.441.467.446.377.731-.575.731zM19.79 12.093a.32.32 0 01.323-.32h2.175a.32.32 0 01.324.32v.285a.32.32 0 01-.324.321h-2.175a.32.32 0 01-.323-.32v-.286zM7.658 7.315c0-.713.61-1.355.61-1.355.198-.268 1.475-1.605 1.96-2.015a9.141 9.141 0 011.42-.998c1.222-.606 2.14-.66 2.14-.66a145.49 145.49 0 013.486-.285c.126-.018.324-.018.396 0 .395 0 .305.356.305.356l-.61 4.796s-.09.803-.954.785L9.563 7.76c-1.222-.018-1.905-.16-1.905-.446zM2.625 20.223c0 2.514 2.049 4.546 4.583 4.546 2.535 0 4.584-2.032 4.584-4.546 0-2.514-2.05-4.546-4.584-4.546s-4.583 2.032-4.583 4.546zm2.336 0a2.239 2.239 0 012.247-2.229 2.24 2.24 0 012.247 2.229 2.239 2.239 0 01-2.247 2.229 2.239 2.239 0 01-2.247-2.229zm35.106 0c0 2.514 2.049 4.546 4.583 4.546 2.535 0 4.584-2.032 4.584-4.546 0-2.514-2.05-4.546-4.584-4.546s-4.583 2.032-4.583 4.546zm2.336 0a2.239 2.239 0 012.247-2.229 2.24 2.24 0 012.247 2.229 2.239 2.239 0 01-2.247 2.229 2.239 2.239 0 01-2.247-2.229z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconSmallCar_svg__a"
                            fill-rule="evenodd"
                            transform="translate(13 13)"
                        ></use>
                    </svg>
                    <p>{{ __("Small") }}</p>
                </button>
                <button
                    @click="toggleCarType('sedan')"
                    :class="
                        filter.car_type.includes('sedan')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('sedan') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconSedan_svg__a"
                                d="M66.776 20.074c.122.425.586.425.586.425l4.195-.236s.853-.26 1.146-2.313c.268-2.053.951-3.517-.122-3.753l-1.146-2.478s-.39-1.605-4.293-2.313c-5-.92-10.365-1.534-10.365-1.534l-.805-.142S46.461 1.476 41.632.673c-4.83-.802-19.243-1.487-25.34 1.676a265.707 265.707 0 00-7.756 4.225l-7.292.613S0 6.645 0 12.451l.951 5.287c.195 1.038.951 1.274.951 1.274l2.805.779c1.098.354 1.17-.354 1.17-.354l1.39-3.375c.952-1.96 3.025-2.927 5.44-2.927 2.853 0 5.243 1.44 5.853 4.107l.731 3.304c.147.661.854.661.854.661H52.85c.61 0 .756-.401.78-.66l1.171-3.872c.757-2.407 2.976-3.823 5.586-3.823 2.585 0 4.755 1.369 5.56 3.705l.83 3.517zm-27.9-9.63c0-.165.122-.306.268-.306h1.83c.145 0 .267.141.267.307v.4c0 .166-.122.308-.268.308h-1.83c-.145 0-.267-.142-.267-.307v-.401zm-2.073-9.039h.122c2.34.094 5.536.66 6.56 1.015 2.39.826 6.122 2.832 7.975 3.941 0 0 2.805 1.7 3.049 2.054.244.377-.244.354-.244.354L38.485 7.8l-1.682-6.396zM17.316 9.43c0-.166.122-.307.268-.307h1.83c.146 0 .268.141.268.307v.4c0 .166-.122.308-.269.308h-1.829c-.146 0-.268-.142-.268-.307V9.43zm3.122-2.455l2.195-4.956c1.756-.992 8.365-.685 12.78-.543l1 6.254-15.975-.755zm-6.512-1.18s4.317-2.667 6.268-3.399L18.34 6.81l-2.487.094-2.22-.165c0 .024-.658 0 .293-.944zM7.219 19.413c0 2.833 2.39 5.146 5.317 5.146 2.926 0 5.317-2.313 5.317-5.146 0-2.832-2.39-5.145-5.317-5.145s-5.317 2.313-5.317 5.145zm2.707 0c0-1.392 1.17-2.525 2.61-2.525 1.439 0 2.61 1.133 2.61 2.525 0 1.393-1.171 2.526-2.61 2.526-1.44 0-2.61-1.133-2.61-2.526zm45.12 0c0 2.833 2.39 5.146 5.316 5.146 2.927 0 5.317-2.313 5.317-5.146 0-2.832-2.39-5.145-5.317-5.145-2.95 0-5.317 2.313-5.317 5.145zm2.707 0c0-1.392 1.17-2.525 2.61-2.525 1.438 0 2.609 1.133 2.609 2.525 0 1.393-1.171 2.526-2.61 2.526-1.439 0-2.61-1.133-2.61-2.526z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconSedan_svg__a"
                            fill-rule="evenodd"
                            transform="translate(3 13)"
                        ></use>
                    </svg>
                    <p>{{ __("Sedan") }}</p>
                </button>
                <button
                    @click="toggleCarType('hatchback')"
                    :class="
                        filter.car_type.includes('hatchback')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('hatchback')
                                ? '#fff'
                                : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconHatchback_svg__a"
                                d="M0 17.555v2.583c0 1.466 1.145 2.101 1.145 2.101l3.393 1.117c.903.328 1.035-.373 1.035-.373v-1.597c0-2.89 2.974-5.232 5.86-5.232 2.731 0 5.485 2.08 5.793 4.728l.287 3.043h30.752l.484-2.54c.617-2.867 2.776-5.231 5.684-5.231 2.599 0 4.912 1.817 5.727 4.334v4.334c0 .24.198.438.44.438l5.023-.657a.44.44 0 00.44-.438v-3.699a.44.44 0 00-.44-.438h-.176V18.08s.088-2.933-3.216-3.896c-3.327-.963-9.87-2.473-9.87-2.473l-3.634-.964S43.22 6.983 37.45 5.057c-1.63-.548-3.239-.745-5.023-.92-5.133-.525-12.028-.11-16.83.306L10.926 0l-.396.394 4.317 4.115c-3.018.263-4.89.525-4.89.525l.308 1.03S4.538 8.47 2.864 9.74c0 0-1.432.94-1.432 2.517v4.246c-1.41 0-1.432 1.05-1.432 1.05zM29.827 5.1c2.93.153 5.617.504 7.225 1.029 2.159.7 4.868 2.123 7.093 3.436a86.933 86.933 0 013.084 1.905s.397.219.419.438c0 .218-.177.306-.551.284l-16.191-1.007-1.08-6.085zm-13.878 5.122l3.348-4.794c.507-.065 1.035-.153 1.608-.197a53.42 53.42 0 015.22-.24c.463 0 .926 0 1.41.022.067 1.86.155 4.312.199 5.953l-11.785-.744zm-5.706-1.357l.022-.066c.044-.043.11-.131.22-.219.243-.197.661-.437 1.278-.7 1.564-.7 3.128-1.554 5.882-2.145l-3.943 4.29c-.243-.044-.529-.087-.86-.153-.792-.153-1.74-.394-2.158-.657a1.572 1.572 0 01-.375-.284c-.066-.044-.066-.066-.066-.066zm39.255 13.33a4.953 4.953 0 004.957 4.947 4.953 4.953 0 004.956-4.947c0-2.714-2.225-4.925-4.956-4.925-2.732 0-4.957 2.211-4.957 4.925zm1.366 0c0-1.97 1.608-3.568 3.59-3.568 1.983 0 3.591 1.598 3.591 3.568s-1.608 3.568-3.59 3.568a3.552 3.552 0 01-3.591-3.568zm-44.366 0a4.953 4.953 0 004.957 4.947 4.953 4.953 0 004.956-4.947c0-2.714-2.225-4.925-4.956-4.925-2.732 0-4.957 2.211-4.957 4.925zm1.366 0c0-1.97 1.608-3.568 3.59-3.568 1.983 0 3.591 1.598 3.591 3.568s-1.608 3.568-3.59 3.568a3.552 3.552 0 01-3.59-3.568z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconHatchback_svg__a"
                            fill-rule="evenodd"
                            transform="translate(7 11)"
                        ></use>
                    </svg>
                    <p>{{ __("Hatchback") }}</p>
                </button>
                <button
                    @click="toggleCarType('combi')"
                    :class="
                        filter.car_type.includes('combi')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('combi') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconWagon_svg__a"
                                d="M0 15.374v2.839a2.728 2.728 0 001.248 2.33l3.695 1.237c.984.364 1.128-.413 1.128-.413v-1.771c0-3.203 3.24-5.775 6.383-5.775 2.975 0 5.974 2.305 6.31 5.241l.312 3.349h33.498l.528-2.79c.672-3.18 3.023-5.776 6.19-5.776 2.832 0 5.352 2.014 6.24 4.78v4.78c0 .267.215.486.48.486l5.47-.728c.264 0 .48-.219.48-.486v-4.076a.484.484 0 00-.48-.485h-.192V15.98s.096-3.252-3.503-4.32c-3.623-1.067-10.75-2.741-10.75-2.741l-3.96-1.068S47.08 3.68 40.793 1.568c-1.776-.607-3.527-.8-5.47-1.02-5.592-.557-13.846-.751-19.053-.29l-.6.048c-3.288.291-6.12.607-6.12.607l-4.03.557s-3.24.194-3.24 2.256c0 0-.695 4.004-.695 5.775v4.707C.024 14.21 0 15.374 0 15.374zM32.49 1.617c3.191.17 6.119.558 7.87 1.14 2.352.752 5.303 2.354 7.727 3.785 1.343.8 2.543 1.553 3.36 2.111 0 0 .431.243.455.485 0 .243-.192.34-.6.316l-17.637-.68-1.175-7.157zM17.037 8.75l.36-6.89c.552-.074 1.103-.05 1.8-.074 1.679-.072 7.222-.267 9.262-.267.503 0 1.007 0 1.535.025.072 2.038.216 5.338.264 7.133l-13.221.073zm-13.702.291c.048-2.499 1.056-5.799 1.056-5.799l8.087-1.116c1.2-.097 2.495-.267 3.023-.267-.048 2.16-.36 5.338-.432 6.891 0 0-3.671.243-11.734.291zM7 20.46c0 3.009 2.424 5.46 5.399 5.46s5.399-2.451 5.399-5.46c0-3.008-2.424-5.459-5.399-5.459A5.453 5.453 0 007 20.46zm1.488 0a3.913 3.913 0 013.911-3.93c2.16 0 3.911 1.77 3.911 3.93 0 2.184-1.751 3.955-3.911 3.955s-3.911-1.77-3.911-3.955zm45.512 0c0 3.009 2.424 5.46 5.399 5.46s5.399-2.451 5.399-5.46c0-3.008-2.424-5.459-5.399-5.459A5.453 5.453 0 0054 20.46zm1.488 0a3.913 3.913 0 013.911-3.93c2.16 0 3.911 1.77 3.911 3.93 0 2.184-1.751 3.955-3.911 3.955s-3.911-1.77-3.911-3.955z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconWagon_svg__a"
                            fill-rule="evenodd"
                            transform="translate(4 12)"
                        ></use>
                    </svg>
                    <p>{{ __("Combi") }}</p>
                </button>
                <button
                    @click="toggleCarType('coupe')"
                    :class="
                        filter.car_type.includes('coupe')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 78 22"
                        :color="
                            filter.car_type.includes('coupe') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <g fill="currentColor" fill-rule="evenodd">
                            <path
                                d="M58.971 16.302c0 2.787 2.251 5.052 5.02 5.052 2.769 0 5.02-2.265 5.02-5.052 0-2.786-2.251-5.052-5.02-5.052-2.769.026-5.02 2.266-5.02 5.052zm1.682 0c0-1.849 1.501-3.36 3.338-3.36 1.837 0 3.338 1.511 3.338 3.36 0 1.85-1.5 3.36-3.338 3.36a3.34 3.34 0 01-3.338-3.36zm-49.578 0c0 2.787 2.251 5.052 5.02 5.052 2.769 0 5.02-2.265 5.02-5.052 0-2.786-2.251-5.052-5.02-5.052-2.795 0-5.02 2.266-5.02 5.052zm1.682 0c0-1.849 1.5-3.36 3.338-3.36 1.837 0 3.338 1.511 3.338 3.36 0 1.85-1.501 3.36-3.338 3.36a3.34 3.34 0 01-3.338-3.36z"
                            ></path>
                            <path
                                d="M0 15.755v.912c0 1.067 1.113 1.12 1.113 1.12h7.22c1.19 0 1.319-.99 1.319-.99l1.112-3.281c.777-2.136 2.873-3.646 5.33-3.646 2.821 0 5.15 2.005 5.59 4.661l.595 2.683s.259 1.614 2.277 1.614l31.336-.13c.699 0 1.035-.99 1.035-.99l1.45-2.942c1.215-3.698 3.88-4.375 5.614-4.375 2.433 0 4.787 1.562 5.538 3.698.103.312.18.65.233.99l.517 2.447s.078.573.776.573h1.165c.414 0 1.19.156 1.526.182 1.76.235 3.908-.026 3.908-.885 0-1.016-1.708-1.589-1.708-1.589v-.833s.078-.677-.336-.677l-1.036-2.682s-.051-1.172-.905-1.797c-1.01-.703-7.297-3.646-22.124-3.88 0 0-4.994-3.256-10.997-4.922 0 0-7.375-1.823-17.182.156l-2.251.599S13.404 3.802 8.46 6.12c0 0-4.476 1.51-5.64 1.719-.854.156-.854.39-.854.39s-.078.26-.078.365v.286l-.207 1.042s-.957 1.302-.336 4.297l-.725.286c0 .026-.621.365-.621 1.25zM19.536 4.193c7.815-2.943 15.862-2.136 15.862-2.136 7.504.547 14.154 4.558 14.154 4.558-20.726.833-26.833-.782-26.833-.782-3.183-.599-3.183-1.64-3.183-1.64z"
                            ></path>
                            <path
                                d="M26.782 1.849l.698 4.844h1.579L27.79 1.849z"
                            ></path>
                        </g>
                    </svg>
                    <p>{{ __("Coupe") }}</p>
                </button>
                <button
                    @click="toggleCarType('cab')"
                    :class="
                        filter.car_type.includes('cab')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('cab') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconCab_svg__a"
                                d="M34.46 7.683L33 4.137c.73-2.17 2.54-.566 2.54-.566l2.018 4.254 8.525.388c.4.024.588-.07.588-.306-.024-.236-.447-.472-.447-.472-.8-.52-1.976-1.251-3.293-2.03-2.376-1.393-3.74-2.337-6.046-3.068-1.458-.472-2.258-.897-4.846-1.086V0c.47.047.965.07 1.412.118 1.928.189 2.21.283 3.952.873C43.566 3.045 47.847 6.68 47.847 6.68l3.881 1.039s11.127.991 14.68 2.03c3.528 1.038 3.434 4.177 3.434 4.177v2.077h.211c.259 0 .47.213.47.472v3.942c0 .26-.211.472-.47.472l-5.363.708a.473.473 0 01-.47-.472v-4.65c-.871-2.69-3.341-4.65-6.117-4.65-3.105 0-5.41 2.526-6.069 5.594l-.517 2.715H18.7l-.306-3.234c-.329-2.856-3.27-5.074-6.186-5.074-3.105 0-6.258 2.501-6.258 5.593v1.7s-.14.755-1.105.4l-3.623-1.18S0 17.632 0 16.074v-2.761s.047-1.133 1.529-1.133c0 0 .259-2.502.33-3.281.07-.779 1.105-1.227 1.058-1.18 5.998-1.345 27.123-.236 27.123-.236l4.42.201zm18.42 10.585a5.29 5.29 0 005.293 5.287 5.29 5.29 0 005.293-5.287 5.29 5.29 0 00-5.293-5.287 5.29 5.29 0 00-5.293 5.287zm1.458 0c0-2.1 1.718-3.824 3.835-3.824a3.836 3.836 0 013.834 3.824 3.821 3.821 0 01-3.834 3.823 3.821 3.821 0 01-3.835-3.823zm-47.376 0a5.29 5.29 0 005.293 5.287 5.29 5.29 0 005.293-5.287 5.274 5.274 0 00-5.293-5.287 5.29 5.29 0 00-5.293 5.287zm1.482 0c0-2.1 1.717-3.824 3.834-3.824a3.836 3.836 0 013.835 3.824 3.821 3.821 0 01-3.835 3.823 3.806 3.806 0 01-3.834-3.823z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconCab_svg__a"
                            fill-rule="evenodd"
                            transform="translate(5 14)"
                        ></use>
                    </svg>
                    <p>{{ __("Cab") }}</p>
                </button>
                <button
                    @click="toggleCarType('suv')"
                    :class="
                        filter.car_type.includes('suv')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('suv') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconSuv_svg__a"
                                d="M2.739 17.993H.627a.62.62 0 00-.627.62V21c0 .344.279.62.627.62H6.08c1.09 0 1.346-.965 1.346-.965l1.996-4.957s.51-1.905 2.947-1.905h5.199c2.344 0 3.017 2.112 3.017 2.112l1.555 3.97c.441 1.17 1.764 1.193 1.764 1.193h25.599c.975 0 1.3-.872 1.3-.872l1.717-4.383s.58-1.997 2.994-1.997h5.199c2.437 0 2.878 1.79 2.878 1.79l1.485 4.75c.14.483.812.506.812.506h3.087a.62.62 0 00.627-.62v-2.364a.62.62 0 00-.627-.62h-1.09v-3.51s-.024-.575-.372-.69v-.94c0-.253-.093-.482-.279-.597-1.392-.918-7.357-1.4-7.357-1.4L49.62 9.593l-5.71-7.94C42.403-.024 40.732 0 40.732 0H8.912a2.166 2.166 0 00-1.996 1.24L2.762 14.068v3.924h-.023zm38.897-16.18c.14.069.325.23.51.436l.395.505c.21.275.418.574.58.78l4.735 6.082h-5.941l-.279-7.803zm-1.787-.23h.023l.256 8.056h-7.682l-.07-8.055h7.473zm-9.19 0h.046V9.64H18.961l1.254-8.055h10.444zm-10.514 9.25c0-.138.116-.253.255-.253h2.182c.14 0 .255.115.255.253v.344a.256.256 0 01-.255.252H20.4a.256.256 0 01-.255-.252v-.344zm13.832 0c0-.138.116-.253.256-.253h2.181c.14 0 .256.115.256.253v.344a.256.256 0 01-.256.252h-2.181a.256.256 0 01-.256-.252v-.344zm-27.2-1.194L8.75 1.584h8.564l-.882 8.055H6.777zm2.251 11.682c0 3.259 2.692 5.921 5.988 5.921 3.296 0 5.988-2.64 5.988-5.921 0-3.26-2.692-5.921-5.988-5.921-3.319.023-5.988 2.662-5.988 5.92zm3.04 0c0-1.607 1.323-2.892 2.925-2.892 1.624 0 2.924 1.285 2.924 2.892 0 1.606-1.323 2.892-2.924 2.892a2.896 2.896 0 01-2.925-2.892zm39.943 0c0 3.259 2.692 5.921 5.987 5.921 3.296 0 5.988-2.64 5.988-5.921 0-3.26-2.692-5.921-5.988-5.921-3.295 0-5.987 2.662-5.987 5.92zm3.063 0c0-1.607 1.323-2.892 2.924-2.892 1.625 0 2.925 1.285 2.925 2.892 0 1.606-1.323 2.892-2.925 2.892-1.601 0-2.924-1.286-2.924-2.892z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconSuv_svg__a"
                            fill-rule="evenodd"
                            transform="translate(5 11)"
                        ></use>
                    </svg>
                    <p>{{ __("SUV") }}</p>
                </button>
                <button
                    @click="toggleCarType('family')"
                    :class="
                        filter.car_type.includes('family')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('family') ? '#fff' : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconMinivan_svg__a"
                                d="M45.747 1.015S43.657.025 41.517 0H6.175S4.74 0 4.132 1.522c-.607 1.546-2.65 5.847-2.65 20.632H.925a.92.92 0 00-.924.918v1.088a.92.92 0 00.924.918l8.678.145c1.288 0 1.336-1.04 1.458-1.547.608-3.551 3.379-6.233 6.733-6.233 3.792 0 6.855 3.455 6.855 7.683v.338h26.325v-.338c0-4.252 3.063-7.683 6.855-7.683 3.282 0 6.004 2.561 6.709 5.992 0 0 .243 1.643 1.702 1.643h5.785a.92.92 0 00.923-.918v-2.634a.92.92 0 00-.923-.918h-.195l-.534-3.865s-3.063-3.407-4.424-4.47C59.53 6.643 45.747 1.015 45.747 1.015zm-27.006 8.987c0 .7-.486 1.184-1.07 1.184H6.492c-.584 0-1.07-.483-1.07-1.111.486-5.098 1.36-7.055 1.385-7.128.17-.386.56-.652.997-.652h9.844c.584 0 1.07.483 1.07.967l.024 6.74zm17.623 0a1.06 1.06 0 01-1.07 1.063h-12.42a1.01 1.01 0 01-.462-.12h-.535c-.583 0-1.07-.484-1.07-1.064v-6.74c0-.58.487-1.063 1.07-1.063h11.109c.145 0 .267.048.388.12h1.896c.584 0 1.07.484 1.07 1.064v6.74h.024zm4.206 6.064c0 .17-.146.338-.34.338h-.681a.331.331 0 01-.34-.338v-2.464a.33.33 0 01.34-.338h.68c.17 0 .34.145.34.338v2.464zm18.157-4.977l-18.498-.193s-1.24.024-1.24-1.111v-6.04c0-1.136 1.24-1.112 1.24-1.112h1.459c2.576-.096 11.157 3.842 11.157 3.842L58.8 9.736c1.629 1.208-.073 1.353-.073 1.353zM52.19 25.126c0 3.068 2.503 5.557 5.615 5.557 3.087 0 5.615-2.489 5.615-5.557 0-3.068-2.504-5.557-5.615-5.557-3.112 0-5.615 2.489-5.615 5.557zm2.868 0c0-1.498 1.24-2.73 2.747-2.73s2.746 1.232 2.746 2.73-1.24 2.73-2.746 2.73a2.736 2.736 0 01-2.747-2.73zm-42.903 0c0 3.068 2.504 5.557 5.615 5.557s5.615-2.489 5.615-5.557c0-3.068-2.504-5.557-5.615-5.557s-5.615 2.489-5.615 5.557zm2.868 0c0-1.498 1.24-2.73 2.747-2.73s2.747 1.232 2.747 2.73-1.24 2.73-2.747 2.73-2.747-1.232-2.747-2.73z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconMinivan_svg__a"
                            fill-rule="evenodd"
                            transform="translate(4 7)"
                        ></use>
                    </svg>
                    <p>{{ __("Family bus") }}</p>
                </button>
                <button
                    @click="toggleCarType('commercial')"
                    :class="
                        filter.car_type.includes('commercial')
                            ? 'bg-btn text-white rounded'
                            : ''
                    "
                    class="flex flex-col items-center justify-center"
                >
                    <svg
                        viewBox="0 0 80 40"
                        :color="
                            filter.car_type.includes('commercial')
                                ? '#fff'
                                : '#000'
                        "
                        width="32"
                        height="20"
                    >
                        <defs>
                            <path
                                id="iconCommercialVehicle_svg__a"
                                d="M0 26.943v.864c0 .356.306.66.663.66h14.041a.746.746 0 00.688-.482l.484-1.627c.79-2.516 3.059-4.32 5.76-4.346 2.956 0 5.402 2.16 5.989 5.058 0 0 .076.915.942.915h31.448c.611 0 .713-.508.713-.508l.178-.636c.892-2.974 3.008-5.21 5.887-5.21 5.25 0 6.167 4.829 6.167 4.829.077.356.434.66.79.66h2.09a.674.674 0 00.663-.66v-2.39a.674.674 0 00-.663-.66h-.153v-4.931c0-1.424-1.401-1.932-1.401-1.932l-4.664-2.135-7.543-13.166C61.263-.051 60.04 0 60.04 0H3.848c-1.02 0-1.07.864-1.07.864v25.393H.663c-.357.05-.663.33-.663.686zm62.894-11.82V6.66h.153l4.332 7.701-1.427.763h-3.058zM48.93 25.52V6.761c0-.838.688-1.5 1.504-1.5h9.582c.84 0 1.503.662 1.503 1.5v10.854c0 .61-.153 1.525-.382 2.11l-2.192 6.023c-.255.712-1.07 1.271-1.835 1.271h-6.65c-.842 0-1.53-.66-1.53-1.5zm13.456 2.746c0 2.516 2.064 4.55 4.587 4.55 2.523 0 4.587-2.034 4.587-4.55 0-2.517-2.064-4.55-4.587-4.55-2.523-.026-4.587 2.033-4.587 4.55zm2.344 0c0-1.22 1.02-2.237 2.243-2.237 1.223 0 2.242.991 2.242 2.237a2.243 2.243 0 01-4.485 0zm-47.68 0c0 2.516 2.064 4.55 4.587 4.55 2.523 0 4.587-2.034 4.587-4.55 0-2.517-2.064-4.55-4.587-4.55a4.54 4.54 0 00-4.587 4.55zm2.344 0c0-1.22.994-2.237 2.243-2.237 1.249 0 2.242.991 2.242 2.237 0 1.22-.993 2.236-2.242 2.236-1.249-.025-2.268-1.016-2.243-2.236zM49.617 6.76v18.76c0 .458.382.84.841.84h6.702c.485 0 1.02-.382 1.198-.84l2.192-6.023c.178-.509.331-1.348.331-1.881V6.76a.847.847 0 00-.841-.838h-9.582a.847.847 0 00-.84.838zm1.223 9.964c0-.203.179-.381.383-.381h.637c.204 0 .382.178.382.381v2.313a.391.391 0 01-.382.381h-.637a.391.391 0 01-.383-.381v-2.313zm-.025-8.87c0-.204.178-.382.382-.382h7.875c.204 0 .382.178.382.381v6.838a.391.391 0 01-.382.38h-7.875a.391.391 0 01-.382-.38V7.854z"
                            ></path>
                        </defs>
                        <use
                            fill="currentColor"
                            xlink:href="#iconCommercialVehicle_svg__a"
                            fill-rule="evenodd"
                            transform="translate(2 5)"
                        ></use>
                    </svg>
                    <p>{{ __("Commercial Vehicles") }}</p>
                </button>
            </div>
            <div class="">
                <p class="font-bold">{{ __("Color") }}</p>
                <div class="flex flex-wrap gap-2">
                    <button
                        @click="toggleColor('white')"
                        style="background-color:white;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('white')"
                            class="fas fa-check text-black"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            white
                        </p>
                    </button>
                    <button
                        @click="toggleColor('black')"
                        style="background-color:black;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('black')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            black
                        </p>
                    </button>
                    <button
                        @click="toggleColor('gray')"
                        style="background-color:gray;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('gray')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            gray
                        </p>
                    </button>
                    <button
                        @click="toggleColor('silver')"
                        style="background-color:silver;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('silver')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            silver
                        </p>
                    </button>
                    <button
                        @click="toggleColor('red')"
                        style="background-color:red;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('red')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            red
                        </p>
                    </button>
                    <button
                        @click="toggleColor('blue')"
                        style="background-color:blue;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('blue')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            blue
                        </p>
                    </button>
                    <button
                        @click="toggleColor('brown')"
                        style="background-color:brown;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('brown')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            brown
                        </p>
                    </button>
                    <button
                        @click="toggleColor('green')"
                        style="background-color:green;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('green')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            green
                        </p>
                    </button>
                    <button
                        @click="toggleColor('beige')"
                        style="background-color:beige;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('beige')"
                            class="fas fa-check text-black"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            beige
                        </p>
                    </button>
                    <button
                        @click="toggleColor('orange')"
                        style="background-color:orange;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('orange')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            orange
                        </p>
                    </button>
                    <button
                        @click="toggleColor('gold')"
                        style="background-color:gold;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('gold')"
                            class="fas fa-check text-black"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            gold
                        </p>
                    </button>
                    <button
                        @click="toggleColor('yellow')"
                        style="background-color:yellow;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('yellow')"
                            class="fas fa-check text-black"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            yellow
                        </p>
                    </button>
                    <button
                        @click="toggleColor('purple')"
                        style="background-color:purple;"
                        class="relative w-5 h-5 rounded-full border border-gray-400 group"
                    >
                        <i
                            v-if="filter.color.includes('purple')"
                            class="fas fa-check text-white"
                        ></i>
                        <p
                            class="hidden group-hover:block z-10 bg-gray-600 px-2 text-sm text-white rounded absolute bottom-5 -left-3"
                        >
                            purple
                        </p>
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ["filters"],
    data() {
        return {
            categoryProperties: [],
            fuels: [],
            gearboxes: [],
            filter: {
                min_price: this.filters.min_price,
                max_price: this.filters.max_price,
                my_from: this.filters.my_from,
                my_to: this.filters.my_to,
                mileage_from: this.filters.mileage_from,
                mileage_to: this.filters.mileage_to,
                fuel: this.filters.fuel,
                gearbox: this.filters.gearbox,
                hp_from: this.filters.hp_from,
                hp_to: this.filters.hp_to,
                color: this.filters.color,
                car_type: this.filters.car_type
            }
        };
    },
    watch: {
        "filter.car_type": function(newValue, oldValue) {
            var car_type = this.filter.car_type;
            this.sort("car_type", car_type.join());
        },
        "filter.color": function(newValue, oldValue) {
            var color = this.filter.color;
            this.sort("color", color.join());
        },
        "filter.min_price": function(newValue, oldValue) {
            this.sort("min_price", newValue);
        },
        "filter.max_price": function(newValue, oldValue) {
            this.sort("max_price", newValue);
        },
        "filter.my_from": function(newValue, oldValue) {
            this.sort("my_from", newValue);
        },
        "filter.my_to": function(newValue, oldValue) {
            this.sort("my_to", newValue);
        },
        "filter.mileage_from": function(newValue, oldValue) {
            this.sort("mileage_from", newValue);
        },
        "filter.mileage_to": function(newValue, oldValue) {
            this.sort("mileage_to", newValue);
        },
        "filter.fuel": function(newValue, oldValue) {
            this.sort("fuel", newValue);
        },
        "filter.gearbox": function(newValue, oldValue) {
            this.sort("gearbox", newValue);
        },
        "filter.hp_from": function(newValue, oldValue) {
            this.sort("hp_from", newValue);
        },
        "filter.hp_to": function(newValue, oldValue) {
            this.sort("hp_to", newValue);
        }
    },
    computed: {
        url() {
            return this.$page.url;
        },
        currentYear() {
            return new Date().getFullYear();
        }
    },
    async mounted() {
        await this.getCategoryAttributes();
        this.categoryProperties.properties.forEach(element => {
            switch (element.property_name) {
                case "fuel":
                    this.fuels = JSON.parse(element.possible_values);
                    break;

                case "gearbox":
                    this.gearboxes = JSON.parse(element.possible_values);
                    break;

                default:
                    break;
            }
        });
    },
    methods: {
        toggleColor(color) {
            var index = this.filter.color.indexOf(color);
            if (index === -1) {
                this.filter.color.push(color);
            } else {
                this.filter.color.splice(index, 1);
            }
        },

        toggleCarType(carType) {
            var index = this.filter.car_type.indexOf(carType);
            if (index === -1) {
                this.filter.car_type.push(carType);
            } else {
                this.filter.car_type.splice(index, 1);
            }
        },
        async getCategoryAttributes() {
            await axios
                .get("/api/v2/category-properties/1")
                .then(Response => (this.categoryProperties = Response.data));
        },
        sort(sort, value) {
            this.$inertia.get(
                this.url,
                { [sort]: value },
                {
                    method: "get",
                    preserveScroll: true
                }
            );
        }
        // asort(sort, value) {
        //     this.filter[sort] = value;
        //     this.$inertia.get(
        //         this.url,
        //         { [sort]: value },
        //         {
        //             method: "get",
        //             preserveScroll: true
        //         }
        //     );
        // }
    }
};
</script>
