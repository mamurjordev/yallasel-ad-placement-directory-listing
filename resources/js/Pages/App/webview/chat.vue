<template>
    <div
        v-if="!updatingData"
        class="app-container my-5 container mx-auto"
        :class="{
            'app-mobile': isDevice
        }"
    >
        <chat-container
            :currentUserId="'' + user.id"
            :user="user"
            :reciever="reciever"
            :isDevice="isDevice"
            @show-demo-options="showDemoOptions = $event"
            v-if="showChat"
        />
    </div>
</template>

<script>
import { roomsRef, usersRef } from "@/firestore";
import ChatContainer from "@/Pages/App/Chat/ChatView";

export default {
    props: ["reciever"],
    components: {
        ChatContainer
    },

    data() {
        return {
            showChat: true,
            isDevice: false,
            showDemoOptions: true,
            updatingData: false
        };
    },

    mounted() {
        this.isDevice = window.innerWidth < 500;
        window.addEventListener("resize", ev => {
            if (ev.isTrusted) this.isDevice = window.innerWidth < 500;
        });
        this.addData();
        this.check();
    },

    watch: {
        currentUserId() {
            this.showChat = false;
            setTimeout(() => (this.showChat = true), 150);
        }
    },

    computed: {
        showOptions() {
            return !this.isDevice || this.showDemoOptions;
        },
        user() {
            return this.$page.props.user;
        }
    },

    methods: {
        resetData() {
            roomsRef.get().then(val => {
                val.forEach(async val => {
                    const ref = roomsRef.doc(val.id).collection("messages");

                    await ref.get().then(res => {
                        if (res.empty) return;
                        res.docs.map(doc => ref.doc(doc.id).delete());
                    });

                    roomsRef.doc(val.id).delete();
                });
            });

            usersRef.get().then(val => {
                val.forEach(val => {
                    usersRef.doc(val.id).delete();
                });
            });
        },
        async check() {},
        addData() {
            this.updatingData = true;
            if (this.reciever) {
                var users = [this.user, this.reciever];
            } else {
                var users = [this.user];
            }
            users.forEach(user => {
                this.addUser(user);
            });
            this.updatingData = false;
        },
        async addUser(userInfo) {
            var user = userInfo;
            var users = await usersRef.where("_id", "==", "" + user.id).get();
            if (!users.docs.length > 0) {
                var users = {
                    _id: "" + user.id,
                    username: user.username,
                    avatar: user.profile_photo ?? ""
                };
                await usersRef.doc("" + users._id).set(users);
            }
        }
    }
};
</script>
