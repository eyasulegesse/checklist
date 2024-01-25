<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Link :href="'/'">
        <div class="flex flex-col justify-center items-center">
            <img src="../../js/images/logo.png" class="w-[150px]" />
            <h3
                class="my-appSmallSize text-[30px] font-bold uppercase text-appWhiteColor-0"
            >
                Leofam Management Group
            </h3>
        </div>
    </Link>
</template>
