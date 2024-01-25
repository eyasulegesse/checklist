<template>
    <div class="flex">
        <Button
            html-type="submit"
            class="bg-appfirstColor-0 mr-appMiddeumSpace px-[23px] py-[2px] rounded-lg"
        >
            <h3 class="text-appWhiteColor-0">Submit</h3>
        </Button>
        <Button
            @click="uistore.closeModal"
            class="bg-appSecondColor-0 px-[23px] py-[2px] rounded-lg"
        >
            <h3 class="text-appWhiteColor-0">Cancel</h3>
        </Button>
    </div>
</template>

<script setup>
import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
</script>
