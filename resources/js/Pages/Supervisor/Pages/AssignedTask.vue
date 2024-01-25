<template>
    <SupervisorLayout>
        <AppHeader title="Assigned Tasks" />
        <List :assignedtasks="assignedtasks" />
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({ assignedtasks: Array });
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import List from "../Components/AssignedTask/List.vue";
console.log(props.assignedtasks);
</script>
