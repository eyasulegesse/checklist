<template>
    <div class="grid grid-cols-4 gap-appBigSpace my-appBigSpace">
        <a-card v-for="assignedTask in assignedTasks" :key="assignedTask.id">
            <template #extra>
                <h3 class="font-bold text-[#144863]">
                    {{ assignedTask.status }}
                </h3>
            </template>
            <div>
                <h3 class="font-bold">Task</h3>
                <h3>{{ assignedTask.task }}</h3>
            </div>
            <div class="flex justify-between my-appMiddeumSpace">
                <h3>Assigned By</h3>
                {{ assignedTask.task_assigned_by.user.name }}
            </div>
            <div class="flex justify-between my-appMiddeumSpace">
                <h3>Assigned To</h3>
                {{ assignedTask.task_assigned_to.user.name }}
            </div>

            <div class="flex justify-between items-center mt-appMiddeumSpace">
                <Icon icon="bi:calendar-date" color="#144863" width="20" />

                <h3
                    class="bg-appfirstColor-0 text-appWhiteColor-0 px-appSmallSize rounded-lg"
                >
                    {{ assignedTask.date }}
                </h3>
            </div>
        </a-card>
    </div>
</template>

<script setup>
defineProps({ assignedTasks: Object });
</script>
