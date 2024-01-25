<template>
    <div class="flex">
        <Sidebar />
        <div class="w-full">
            <Header />

            <div class="pl-appBigSpace bg-appWhiteColor-0 pt-appBigSpace">
                <a-card>
                    <slot />
                </a-card>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";
</script>

<style scoped></style>
