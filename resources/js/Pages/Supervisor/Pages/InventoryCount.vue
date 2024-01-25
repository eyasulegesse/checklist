<template>
    <SupervisorLayout>
        <AppHeader title="Inventory Count" />
        <LinkButton
            url="/inventory_count_add"
            title="Add New Inventory Count"
            class="mb-appBigSpace"
        />
        <List :inventoryCounts="inventoryCounts" />
    </SupervisorLayout>
</template>

<script setup>
defineProps(["inventoryCounts"]);
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import LinkButton from "@/Shared/LinkButton.vue";
import List from "../Components/InventoryCount/List.vue";
</script>
