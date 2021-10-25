<template>
  <div class="bg-gray-50">
    <!-- Header -->
    <section
      class="md:container mx-auto px-3 flex justify-between font-roboto my-3"
    >
      <inertia-link href="/" class="text-red-500 text-3xl font-black"
        >Yallasell</inertia-link
      >
      <div class="self-end">
        <i class="fas fa-user"></i>
        {{ user.name }}
      </div>
    </section>

    <form
      @submit.prevent="submit"
      class="md:container mx-auto bg-white border border-gray-300 py-5 px-4 font-roboto"
      enctype="multipart/form-data"
    >
      <div class="flex justify-start items-baseline space-s-5 mb-5">
        <div class="text-4xl font-medium font-sans">
          {{ __("Post an ad on Yallasell") }}
        </div>
        <inertia-link href="" class="hidden md:block underline text-sm">{{
          __("Price information")
        }}</inertia-link>
      </div>
      <div class="space-s-3">
        <label for="" class="text-sm">
          <input
            type="radio"
            name="posttype"
            class="w-3 h-3 focus:ring-0 cursor-pointer"
            value="1"
            v-model="form.is_individual"
          />
          {{ __("Private person") }}
        </label>
        <label for="" class="text-sm">
          <input
            type="radio"
            name="posttype"
            class="w-3 h-3 focus:ring-0 cursor-pointer"
            value="0"
            v-model="form.is_individual"
          />
          {{ __("Business") }}
        </label>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">{{ __("Name") }}</label>
        <input
          type="text"
          v-model="form.name"
          class="block py-3 md:py-1 w-full md:w-2/6 border-gray-400 rounded"
        />
        <p class="text-red-500" v-if="errors.name">
          {{ errors.name }}
        </p>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">{{ __("E-mail") }}</label>
        <input
          type="email"
          class="readonly block py-3 md:py-1 w-full md:w-2/6 border-gray-400 rounded"
          readonly
          v-model="form.email"
        />
        <p class="text-red-500" v-if="errors.email">
          {{ errors.email }}
        </p>
      </div>
      <div class="md:grid grid-cols-6 md:space-s-8">
        <div class="mt-3 col-span-2">
          <label for="" class="text-sm font-medium">{{ __("Phone") }}</label>
          <input
            type="text"
            placeholder="+964 *********"
            v-model="form.phone"
            class="block py-3 md:py-1 w-full col-span-2 border-gray-400 rounded"
          />
          <p class="text-red-500" v-if="errors.phone">
            {{ errors.phone }}
          </p>
        </div>
        <label for="" class="font-light col-span-4 mt-10">
          <input
            type="checkbox"
            v-model="form.hidePhoneInAd"
            class="w-3 h-3 focus:ring-0"
            value="1"
          />
          {{ __("hide in the ad") }}
        </label>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">{{ __("Category") }}</label>
        <select
          class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0"
          v-model="form.category_id"
        >
          <option value="">Choose a Category</option>
          <option
            v-for="category in categories"
            :key="category.id"
            :value="category.id"
            selected
          >
            {{ category.category_name }}
          </option>
        </select>
        <p class="text-red-500" v-if="errors.category_id">
          {{ errors.category_id }}
        </p>
      </div>
      <div
        class="my-5 text-sm grid md:block grid-flow-col grid-rows-2 space-s-3"
      >
        <label for="">
          <input
            type="radio"
            name="postreason"
            value="sale"
            v-model="form.reason"
            class="focus:ring-0"
          />
          {{ __("For sale") }}
        </label>
        <label for="">
          <input
            type="radio"
            name="postreason"
            value="rent"
            v-model="form.reason"
            class="focus:ring-0"
          />
          {{ __("For rent") }}
        </label>
        <label for="">
          <input
            type="radio"
            name="postreason"
            value="wishToRent"
            v-model="form.reason"
            class="focus:ring-0"
          />
          {{ __("Wish to rent") }}
        </label>
        <label for="">
          <input
            type="radio"
            name="postreason"
            value="wishToPurchase"
            v-model="form.reason"
            class="focus:ring-0"
          />
          {{ __("Wish to Purchase") }}
        </label>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">{{ __("City") }}</label>
        <select
          class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0"
          v-model="form.city_id"
        >
          <option v-for="city in cities" :key="city.id" :value="city.id">
            {{ city.city_name }}
          </option>
        </select>
        <p class="text-red-500" v-if="errors.city_id">
          {{ errors.city_id }}
        </p>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">
          {{ __("Region") }}
        </label>
        <select
          class="block py-3 md:py-1 w-full md:w-2/6 rounded border border-gray-400 focus:border-gray-400 focus:ring-0"
          v-model="form.region_id"
        >
          <option v-for="region in regions" :key="region.id" :value="region.id">
            {{ region.region_name }}
          </option>
        </select>
        <p class="text-red-500" v-if="errors.region_id">
          {{ errors.region_id }}
        </p>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">{{ __("ZIP code") }}</label>
        <input
          type="text"
          class="border-gray-400 block py-3 md:py-1 rounded w-full md:w-32"
          v-model="form.zipcode"
        />
        <p class="text-red-500" v-if="errors.zipcode">
          {{ errors.zipcode }}
        </p>
      </div>
      <div class="mt-3 bg-gray-100 p-4 w-10/12 pe-20">
        <label for="registration">{{ __("Registration no") }}</label>
        <div class="space-s-2 mt-1">
          <input
            type="text"
            placeholder="ABC123"
            class="py-1 w-32"
            v-model="form.registration_no"
          />
          <button class="bg-btn text-white py-2 px-5 text-sm rounded">
            {{ __("Get car details") }}
          </button>
        </div>
        <p class="text-red-500" v-if="errors.registration_no">
          {{ errors.registration_no }}
        </p>
        <p class="text-sm font-light mt-2">
          {{
            __(
              "The registration number does not appear in the ad. We use it to pick up the car's equipment, model year, mileage, fuel type etc. So that you do not have to fill it in yourself!"
            )
          }}
        </p>

        <section
          class="grid grid-flow-row grid-cols-3 gap-x-10 gap-y-2 border-t border-gray-400 pt-2 mt-8"
        >
          <div class="">
            <label for="" class="text-sm font-medium">{{
              __("Model Year")
            }}</label>
            <select
              name=""
              id=""
              class="block py-1 w-full"
              v-model="form.model_year"
            >
              <option value="" disabled selected>Select your option</option>
              <option
                v-for="modelYear in modelYears"
                :key="modelYear.id"
                :value="modelYear"
              >
                {{ modelYear }}
              </option>
            </select>
          </div>
          <div class="">
            <label for="" class="text-sm font-medium">{{
              __("Mileage")
            }}</label>
            <select
              name=""
              id=""
              class="block py-1 w-full"
              v-model="form.mileage"
            >
              <option value="">Select Mileage</option>
              <option
                v-for="(mileage, value) in mileages"
                :key="mileage.id"
                :value="value"
              >
                {{ mileage }}
              </option>
            </select>
          </div>
          <div class="">
            <label for="" class="text-sm font-medium">{{
              __("Body type")
            }}</label>
            <select
              name=""
              id=""
              class="block py-1 w-full"
              v-model="form.body_type"
            >
              <option value="">Select Body type</option>
              <option
                v-for="(bodyType, value) in bodyTypes"
                :key="bodyType.id"
                :value="value"
              >
                {{ bodyType }}
              </option>
            </select>
          </div>
          <div class="">
            <label for="" class="text-sm font-medium">{{
              __("Gearbox")
            }}</label>
            <select
              name=""
              id=""
              class="block py-1 w-full"
              v-model="form.gearbox"
            >
              <option value="">Select gearbox</option>
              <option
                v-for="gearbox in gearboxs"
                :key="gearbox.id"
                :value="gearbox"
              >
                {{ gearbox }}
              </option>
            </select>
          </div>
          <div class="">
            <label for="" class="text-sm font-medium">{{ __("Fuel") }}</label>
            <select name="" id="" class="block py-1 w-full" v-model="form.fuel">
              <option value="">Select fuel</option>
              <option
                v-for="(fuel, index) in fuels"
                :key="index"
                :value="index + 1"
              >
                {{ fuel }}
              </option>
            </select>
          </div>
        </section>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium"
          >{{ __("Heading") }}
          <span class="font-light text-gray-600">
            ({{
              __(
                'The title mus contain the car\'s make and model, for example "Volvo V70"'
              )
            }})
          </span>
        </label>
        <input
          type="text"
          v-model="form.heading"
          class="block py-3 md:py-1 w-full rounded md:w-4/6 border-gray-400"
        />
        <p class="text-red-500" v-if="errors.heading">
          {{ errors.heading }}
        </p>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">
          {{ __("Text") }}
        </label>
        <vue-editor
          class="border-gray-400 block py-3 md:py-1 w-full rounded md:w-4/6"
          v-model="form.text"
          :editorToolbar="customToolbar"
        ></vue-editor>
        <p class="text-red-500" v-if="errors.text">
          {{ errors.text }}
        </p>
      </div>
      <div class="mt-3">
        <label for="" class="text-sm font-medium">
          {{ __("Price") }}
        </label>
        <div class="flex justify-items-start input-group">
          <input type="number" class="border-gray-400" v-model="form.price" />
          <p class="self-center p-3 text-sm border border-gray-400">IQD</p>
        </div>
        <p class="text-red-500" v-if="errors.price">
          {{ errors.price }}
        </p>
      </div>

      <div class="my-10">
        <div class="flex justify-start space-s-2">
          <div class="relative">
            <div
              v-if="previewImages[0]"
              @click="cancelImage1"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input1">
              <img
                v-if="previewImages[0]"
                :src="previewImages[0]"
                alt=""
                class="border border-gray-400 w-28 h-20"
              />
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input1"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image1"
            />
          </div>
          <div class="relative">
            <div
              v-if="previewImages[1]"
              @click="cancelImage2"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input2">
              <img
                v-if="previewImages[1]"
                :src="previewImages[1]"
                alt=""
                class="border border-gray-400 w-28 h-20"
              />
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input2"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image2"
            />
          </div>
          <div class="relative">
            <div
              v-if="previewImages[2]"
              @click="cancelImage3"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input3">
              <img
                v-if="previewImages[2]"
                :src="previewImages[2]"
                alt=""
                class="border border-gray-400 w-28 h-20"
              />
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input3"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image3"
            />
          </div>
          <div class="relative">
            <div
              v-if="previewImages[3]"
              @click="cancelImage4"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input4">
              <img
                v-if="previewImages[3]"
                :src="previewImages[3]"
                alt=""
                class="border border-gray-400 w-28 h-20"
              />
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input4"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image4"
            />
          </div>
          <div class="relative">
            <div
              v-if="previewImages[4]"
              @click="cancelImage5"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input5">
              <img
                v-if="previewImages[4]"
                :src="previewImages[4]"
                alt=""
                class="border border-gray-400 w-28 h-20"
              />
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input5"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image5"
            />
          </div>
          <div class="relative">
            <div
              v-if="previewImages[5]"
              @click="cancelImage6"
              class="cursor-pointer absolute px-1 -top-2 right-0 z-10 bg-gray-400 h-max text-white"
            >
              <i class="fas fa-times"></i>
            </div>
            <label for="file-input6">
              <div class="relative" v-if="previewImages[5]">
                <img
                  :src="previewImages[5]"
                  class="border border-gray-400 w-28 h-20"
                />
              </div>
              <img
                v-else
                src="/media/site/camera.svg"
                alt=""
                class="border border-gray-400 px-8 py-6"
              />
            </label>
            <input
              id="file-input6"
              type="file"
              class="file hidden"
              data-preview-file-type="text"
              ref="photo"
              @change="image6"
            />
          </div>
        </div>
      </div>

      <div class="mt-3">
        <label for="" class="font-medium text-sm">
          {{ __("choose payment") }}
        </label>
        <div
          class="border border-gray-300 p-3 block w-full rounded md:w-4/6 font-light"
        >
          <img
            src="/media/site/credit_card_logos.svg"
            class="w-20 mb-3"
            alt=""
          />
          <label for="" class="">
            <input type="radio" class="focus:ring-0" />
            Cards - Visa, Mastercard or American Express
          </label>
        </div>
      </div>
      <div class="mt-5">
        <div class="text-sm font-medium mb-2">
          {{ __("Accept terms and conditions") }}
        </div>
        <label for="" class="text-sm">
          <input type="checkbox" class="w-3 h-3" v-model="form.terms" />
          {{ __("Yes, I accept Yallasell's") }}
          <inertia-link href="/termsofuse" class="underline"
            >{{ __("terms of use") }}.</inertia-link
          >
        </label>
      </div>
      <div
        class="md:space-s-8 mt-6 text-sm text-center md:text-left space-y-4 md:space-y-0"
      >
        <div
          href="#!"
          class="cursor-pointer text-primary border border-gray-300 rounded-sm py-2 px-14 block md:inline-block"
          @click="openPreview"
        >
          {{ __("Preview ad") }}
        </div>
        <button
          type="submit"
          class="block md:inline-block text-white border border-1 bg-bg4 px-14 py-2 rounded"
        >
          {{ __("Place an ad") }}
        </button>
      </div>
      <div class="mt-5 w-full md:w-3/6 text-sm text-gray-600">
        <img src="" alt="" />
        <p class="">
          {{
            __(
              "When you advertise with us, we process your personal information. We do this to make Blocket better and to enable us to make this an even safer and more secure place for buyers and sellers."
            )
          }}
          <inertia-link href="#!" class="underline">{{
            __("Read more here.")
          }}</inertia-link>
        </p>
      </div>
      <section class="mt-6">
        <inertia-link href="/cookies" class="text-xs font-light text-gray-800">
          {{ __("Cookie Policy") }}
        </inertia-link>
      </section>
    </form>

    <!-- Modal -->
    <preview
      :Hidden="isHidden"
      :previewImages="previewImages"
      :form="form"
    ></preview>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

import Preview from "@/Components/Preview";

export default {
  components: {
    VueEditor,
    Preview,
  },
  props: ["user", "categories", "cities", "regions", "errors"],
  data: function () {
    return {
      customToolbar: [
        [{ size: ["small", false, "large"] }],
        [{ header: 5 }, { header: 6 }],
        ["bold", "italic", "underline", "strike"],
        [
          { align: "" },
          { align: "center" },
          { align: "right" },
          { align: "justify" },
        ],
        [{ font: [] }],
        ["blockquote"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ direction: "rtl" }],
      ],
      isHidden: true,
      form: {
        is_individual: 1,
        user_id: this.user.id,
        name: this.user.name,
        email: this.user.email,
        phone: null,
        hidePhoneInAd: 1,
        category_id: "",
        reason: "sale",
        price: null,

        zipcode: null,

        city_id: null,
        region_id: null,

        images: [],

        image1: null,
        image2: null,
        image3: null,
        image4: null,
        image5: null,
        image6: null,

        heading: null,
        text: null,
        payment: null,

        // Car
        registration_no: null,
        model_year: "",
        mileage: "",
        body_type: "",
        gearbox: "",
        fuel: "",

        terms: false,
      },
      image: null,
      previewImages: [null, null, null, null, null, null],

      modelYears: [
        2021,
        2020,
        2019,
        2018,
        2017,
        2016,
        2015,
        2014,
        2013,
        2012,
        2011,
        2010,
        2009,
        2008,
        2007,
        2006,
        2005,
        2004,
        2003,
        2002,
        2001,
        2000,
        1999,
        1998,
        1997,
        1996,
        1995,
        1994,
        1993,
        1992,
        1991,
        1990,
        1989,
        1988,
        1987,
        1986,
        1985,
        1984,
        1983,
        1982,
        1981,
        1980,
        "70s",
        "60s",
        "50s",
        "40s",
        "30s or old",
      ],
      mileages: {
        10: "0 - 499",
        20: "500 - 999",
        30: "1,000 - 1,499",
        40: "1,500 - 1,999",
        50: "2,000 - 2,499",
        60: "2,500 - 2,999",
        70: "3,000 - 3,499",
        80: "3,500 - 3,999",
        90: "4,000 - 4,499",
        100: "4,500 - 4,999",
        110: "5,000 - 5,499",
        120: "5,500 - 5,999",
        130: "6,000 - 6,499",
        140: "6,500 - 6,999",
        150: "7,000 - 7,499",
        160: "7,500 - 7,999",
        170: "8,000 - 8,499",
        180: "8,500 - 8,999",
        190: "9,000 - 9,499",
        200: "9,500 - 9,999",
        210: "10,000 - 10,499",
        220: "10,500 - 10,999",
        230: "11,000 - 11,499",
        240: "11,500 - 11,999",
        250: "12,000 - 12,499",
        260: "12,500 - 12,999",
        270: "13,000 - 13,499",
        280: "13,500 - 13,999",
        290: "14,000 - 14,499",
        300: "14,500 - 14,999",

        310: "15,000 - 15,499",
        320: "15,500 - 15,999",
        330: "16,000 - 16,499",
        340: "16,500 - 16,999",
        350: "17,000 - 17,499",
        360: "17,500 - 17,999",
        370: "18,000 - 18,499",
        380: "18,500 - 18,999",
        390: "19,000 - 19,499",
        400: "19,500 - 19,999",

        410: "20,000 - 20,499",
        420: "20,500 - 20,999",
        430: "21,000 - 21,499",
        440: "21,500 - 21,999",
        450: "22,000 - 22,499",
        460: "22,500 - 22,999",
        470: "23,000 - 23,499",
        480: "23,500 - 23,999",
        490: "24,000 - 24,499",
        500: "24,500 - 24,999",

        510: "25,000 - 25,499",
        520: "25,500 - 25,999",
        530: "26,000 - 26,499",
        540: "26,500 - 26,999",
        550: "27,000 - 27,499",
        560: "27,500 - 27,999",
        570: "28,000 - 28,499",
        580: "28,500 - 28,999",
        590: "29,000 - 29,499",
        600: "29,500 - 29,999",

        610: "30,000 - 34,999",
        620: "35,000 - 39,999",
        630: "40,000 - 44,499",
        640: "45,000 - 49,999",
        650: "More than 50,000",
      },
      bodyTypes: {
        small_car: "Small Car",
        then: "Then",
        hatchback: "Hatchback",
        combi: "Combi",
        coupe: "Coupe",
        cab: "Cab",
        suv: "SUV",
        family_bus: "Family bus",
        commercial_vehicles: "Commercial vehicles",
      },
      gearboxs: ["manual", "automatic"],
      fuels: ["Petrol", "Diesel", "Electric", "Environmental fuel / Hybrid"],
    };
  },

  methods: {
    image1: function (e) {
      this.form.image1 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image1);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },
    image2: function (e) {
      this.form.image2 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image2);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },
    image3: function (e) {
      this.form.image3 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image3);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },
    image4: function (e) {
      this.form.image4 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image4);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },
    image5: function (e) {
      this.form.image5 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image5);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },
    image6: function (e) {
      this.form.image6 = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.form.image6);
      reader.onload = (e) => {
        this.previewImages.pop();
        this.previewImages.unshift(e.target.result);
      };
    },

    cancelImage1: function (e) {
      this.form.image1 = null;
      this.previewImages.splice(0, 1);
      this.previewImages.push(null);
    },
    cancelImage2: function (e) {
      this.form.image2 = null;
      this.previewImages.splice(1, 1);
      this.previewImages.push(null);
    },
    cancelImage3: function (e) {
      this.form.image3 = null;
      this.previewImages.splice(2, 1);
      this.previewImages.push(null);
    },
    cancelImage4: function (e) {
      this.form.image4 = null;
      this.previewImages.splice(3, 1);
      this.previewImages.push(null);
    },
    cancelImage5: function (e) {
      this.form.image5 = null;
      this.previewImages.splice(4, 1);
      this.previewImages.push(null);
    },
    cancelImage6: function (e) {
      this.form.image6 = null;
      this.previewImages.splice(5, 1);
      this.previewImages.push(null);
    },

    images: function (e) {
      this.image = e.target.files[0];
      this.form.images.push(this.image);

      const reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.previewImages.push(e.target.result);
      };
    },
    openPreview: function () {
      this.isHidden = !this.isHidden;
    },
    submit() {
      var data = new FormData();
      data.append("is_individual", this.form.is_individual || "");
      data.append("user_id", this.form.user_id || "");
      data.append("name", this.form.name || "");
      data.append("email", this.form.email || "");
      data.append("phone", this.form.phone || "");
      data.append("hidePhoneInAd", this.form.hidePhoneInAd || "");
      data.append("category_id", this.form.category_id || "");
      data.append("reason", this.form.reason || "");
      data.append("price", this.form.price || "");
      data.append("zipcode", this.form.zipcode || "");
      data.append("city_id", this.form.city_id || "");
      data.append("region_id", this.form.region_id || "");
      data.append("image1", this.form.image1 || "");
      data.append("image2", this.form.image2 || "");
      data.append("image3", this.form.image3 || "");
      data.append("image4", this.form.image4 || "");
      data.append("image5", this.form.image5 || "");
      data.append("image6", this.form.image6 || "");
      data.append("heading", this.form.heading || "");
      data.append("text", this.form.text || "");
      data.append("payment", this.form.imagpaymentes || "");

      this.$inertia.post("/advert", data);

      //   this.$inertia.post("/advert", this.form);
    },
  },
};
</script>

<style scoped>
.readonly {
  background-color: #f6f6f6;
  border: 1px solid #cccccc;
  cursor: not-allowed;
}

select {
  background: rgb(255, 255, 255);
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 1) 0%,
    rgba(238, 238, 238, 1) 80%
  );
}

.input-group p {
  background-color: #eeeeee;
}

input {
  box-shadow: var(--tw-ring-inset) 0 0 0 calc(0px + var(--tw-ring-offset-width))
    var(--tw-ring-color);
}
</style>
