<template>
    <div>
        <div class="flex">
            <Sidebar />
            <div class="flex flex-col w-full">
                <Header />

                <div
                    class="pl-appBigSpace bg-appWhiteColor-0 pt-appBigSpace w-full"
                >
                    <a-card>
                        <slot />
                    </a-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";
</script>

<style scoped></style>
