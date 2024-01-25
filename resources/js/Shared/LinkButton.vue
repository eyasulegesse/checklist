<template>
    <div
        class="bg-appfirstColor-0 w-[250px] px-appSmallSize py-[3px] mb-appBigSpace rounded-lg"
    >
        <Link :href="url" :method="method" as="button">
            <div class="flex">
                <Icon
                    icon="tdesign:plus"
                    color="white"
                    width="20"
                    class="mr-1"
                />
                <h3 class="text-appWhiteColor-0">{{ title }}</h3>
            </div>
        </Link>
    </div>
</template>

<script setup>
defineProps({
    url: String,
    title: String,
    method: "GET",
});
</script>
