<template>
    <div>
        <a-button
            @click="uistore.openModal"
            class="bg-appfirstColor-0 mb-appMiddeumSpace"
            ><div class="flex items-center justify-center">
                <Icon
                    icon="tdesign:plus"
                    color="white"
                    width="20"
                    class="mr-1"
                />
                <h3 class="text-appWhiteColor-0">{{ title }}</h3>
            </div></a-button
        >
    </div>
</template>

<script setup>
defineProps(["title"]);

import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
</script>
