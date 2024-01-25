<template>
    <SupervisorLayout>
        <AppHeader title="Checklist Management" />
        <LinkButton title="Add New Checklist" url="/supervisor_checklist_add" />
        <List :checklists="checklists" />
    </SupervisorLayout>
</template>

<script setup>
defineProps(["checklists"]);
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import LinkButton from "@/Shared/LinkButton.vue";
import List from "../Components/Checklist/List.vue";
</script>
