<template>
    <admin-layout>
        div class="flex flex-wrap mt-4">
        <div class="w-full px-4">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0 p-5"
            >
                <div
                    v-if="success"
                    class="text-green-600 font-bold text-lg mb-5 pb-2 border-b border-green-500"
                >
                    {{ success }}
                </div>
                <div
                    class="mb-5 border-b border-gray-300 pb-5 flex items-center justify-between w-full"
                >
                    <h1 class="font-bold">
                        Category page widgets
                    </h1>
                    <inertia-link
                        href="/panel/widgets"
                        class="text-sm text-white bg-blue-500 px-5 py-1 rounded font-semibold"
                        >Return back</inertia-link
                    >
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div class="">
                        <h3 class="mb-5">Widgets</h3>
                        <draggable
                            class="dragArea list-group space-y-3"
                            :list="preWidgets"
                            :group="{
                                name: 'people',
                                pull: 'clone',
                                put: false
                            }"
                            :clone="cloneWidget"
                            @change="log"
                        >
                            <div
                                class="list-group-item cursor-pointer border border-gray-600 px-5 w-max"
                                v-for="element in preWidgets"
                                :key="element.id"
                            >
                                {{ element.name }}
                            </div>
                        </draggable>
                    </div>
                    <form
                        enctype="multipart/form-data"
                        @submit.prevent="submit"
                    >
                        <div class="">
                            <h3 class="mb-5">Used widgets</h3>
                            <draggable
                                class="dragArea list-group space-y-3"
                                tag="ul"
                                :list="usedWidgets"
                                handle=".handle"
                                group="people"
                                s
                                @change="log"
                            >
                                <li
                                    class="list-group-item cursor-pointer border border-gray-600 px-5"
                                    v-for="(element, index) in usedWidgets"
                                    :key="index"
                                >
                                    <div class="w-full flex justify-end">
                                        <button
                                            @click="removeWidget(index)"
                                            class="text-red-600 border border-red-600 bg-red-50 rounded px-5 py-1 mt-2"
                                        >
                                            remove
                                        </button>
                                    </div>
                                    <div
                                        v-if="element.name == 'widget1'"
                                        class="grid grid-cols-1 gap-2 py-2 rounded"
                                    >
                                        <label for="">Title</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="element.title"
                                        />
                                        <label for="">Link</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="element.link"
                                        />
                                        <img
                                            v-if="preViewImage[element.id]"
                                            :src="preViewImage[element.id]"
                                            alt=""
                                            class="w-72"
                                        />
                                        <input
                                            :id="'image' + element.id"
                                            @change="photoUpload(element.id)"
                                            type="file"
                                            accept="jpg"
                                            class="my-5"
                                        />
                                        <label for="">Description</label>
                                        <vue-editor
                                            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                            v-model="element.text"
                                            :editorToolbar="customToolbar"
                                        ></vue-editor>
                                    </div>
                                </li>
                            </draggable>
                        </div>
                    </form>
                </div>
                <button
                    class="bg-gray-700 text-white mt-10 py-2 rounded w-max mx-auto px-10"
                    @click="submit()"
                >
                    Submit
                </button>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import draggable from "vuedraggable";
import { VueEditor } from "vue2-editor";

let idGlobal = 0;
export default {
    // name: "clone",
    // display: "Clone",
    // order: 2,
    props: ["widgets"],
    components: {
        AdminLayout,
        draggable,
        VueEditor
    },
    data() {
        return {
            preWidgets: [{ id: 1, name: "widget1" }],
            usedWidgets: [],
            uploadImage: [],
            preViewImage: [],

            customToolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ size: ["small", false, "large", "huge"] }],
                [{ header: 1 }, { header: 2 }],
                ["bold", "italic", "underline", "strike"],
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                [{ font: [] }],
                ["blockquote"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }],
                [{ color: [] }, { background: [] }],
                [{ direction: "rtl" }]
            ]
        };
    },
    created() {
        if (this.widgets.length) {
            console.log(this.widgets);
            this.widgets.forEach(element => {
                this.usedWidgets = JSON.parse(element.widget);
            });
        } else {
            console.log("notok");
        }
    },
    methods: {
        log: function(evt) {
            window.console.log(evt);
        },
        cloneWidget({ name }) {
            return {
                id: idGlobal++,
                name: `${name}`
            };
        },
        photoUpload(id) {
            console.log(id);
            var image = document.getElementById("image" + id);
            console.log(image.value.split(".")[1]);
            var ext = image.value.split(".")[1];

            this.usedWidgets.forEach(element => {
                if (element.id == id) {
                    this.uploadImage[id] = image.files[0];

                    element.image = "catimage" + id + "." + ext;
                    // this.uploadImage = image;

                    const reader = new FileReader();
                    reader.readAsDataURL(image.files[0]);

                    // console.log(image.files[0]);

                    reader.onload = e => {
                        this.preViewImage[id] = e.target.result;
                        // console.log(e.target.result);
                    };
                }
            });
            console.log(this.preViewImage[id]);
        },
        submit() {
            var i = 0;
            var data = new FormData();
            data.append("place", "category");
            data.append("image", this.uploadImage);
            data.append("widget", JSON.stringify(this.usedWidgets));
            this.uploadImage.forEach(element => {
                data.append("catimage" + i++, element);
            });

            this.$inertia.post("/panel/widgets", data);
        },
        removeWidget(index) {
            this.usedWidgets.splice(index, 1);
        }
    },
    computed: {
        success() {
            return this.$page.props.flash.success;
        }
    }
};
</script>

<style>
.ql-container {
    height: max-content !important;
}
.dragArea {
    min-height: 100px;
}
</style>
