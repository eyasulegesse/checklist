<template>
    <AdminLayout>
        <AppHeader title="Dashboard" />
        <div class="flex gap-appMiddeumSpace">
            <AppHeader title="Latest Checklist" />
            <Link
                href="/checklist_report"
                method="GET"
                as="button"
                class="bg-[#D1D1D1] w-[150px] h-[25px] rounded-lg mt-[26px]"
                >View More</Link
            >
        </div>
        <div class="mt-appBigSpace">
            <LatestChecklist :checklist="checklist" />
        </div>
        <div class="mt-appBigSpace">
            <AppHeader title="Latest Assigned Tasks" />
            <LatestAssignedTask :assignedTasks="assignedTasks" />
        </div>

        <div class="mt-appBigSpace">
            <AppHeader title="Statistics" />
            <div class="grid grid-cols-3 gap-appBigSpace">
                <a-card>
                    <BreakageandSpoileChart
                        :breakaTotal="breakaTotal"
                        :spoileTotal="spoileTotal"
                    />
                </a-card>

                <a-card>
                    <CheckListChart
                        :mainChecklist="mainChecklist"
                        :subChecklist="subChecklist"
                    />
                </a-card>
                <a-card>
                    <AssignTaskChart :assignTask="assignTask" />
                </a-card>
            </div>
        </div>
    </AdminLayout>
</template>
<script setup>
const props = defineProps({
    breakaTotal: Number,
    spoileTotal: Number,
    mainChecklist: Number,
    subChecklist: Number,
    assignTask: Number,
    assignedTasks: Object,
    checklist: Object,
});
console.log(props.checklist);

import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import LatestChecklist from "../Components/Report/Checklist/LatestChecklist.vue";
import BreakageandSpoileChart from "../Components/Report/BreakageandSpoileChart.vue";
import AssignTaskChart from "../Components/Report/AssignedTask/AssignTaskChart.vue";
import CheckListChart from "../Components/Report/CheckListChart.vue";
import LatestAssignedTask from "../Components/Report/AssignedTask/LatestAssignedTask.vue";
</script>
