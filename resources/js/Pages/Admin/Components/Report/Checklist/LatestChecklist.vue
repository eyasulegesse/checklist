<template>
    <div class="grid grid-cols-3 gap-appMiddeumSpace">
        <a-card
            v-for="checklist in checklist"
            :key="checklist.id"
            :title="checklist.checklist_task.task"
        >
            <template #extra>
                <div class="flex gap-appSmallSize">
                    <Icon icon="mdi:user" color="#144863" width="20" />
                    <h3 class="font-bold">{{ checklist.user.name }}</h3>
                </div>
            </template>
            <div class="flex justify-between my-appSmallSize">
                <h3>Branch</h3>
                <h3>{{ checklist.branch.name }}</h3>
            </div>
            <div class="flex justify-between items-center my-appSmallSize">
                <h3>Department</h3>
                <h3>{{ checklist.department.name }}</h3>
            </div>
            <div class="flex justify-between items-center my-appSmallSize">
                <h3>Main Checklist</h3>
                <h3>{{ checklist.main_check_list.name }}</h3>
            </div>
            <div class="flex justify-between items-center my-appSmallSize">
                <h3>Sub Checklist</h3>
                <h3>{{ checklist.sub_checklist.name }}</h3>
            </div>
            <div class="flex justify-between items-center mt-appMiddeumSpace">
                <Icon icon="bi:calendar-date" color="#144863" width="20" />

                <h3
                    class="bg-appfirstColor-0 text-appWhiteColor-0 px-appSmallSize rounded-lg"
                >
                    {{ checklist.date }}
                </h3>
            </div>
        </a-card>
    </div>
</template>

<script setup>
defineProps({ checklist: Object });
</script>
