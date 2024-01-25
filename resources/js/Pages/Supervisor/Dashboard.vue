<template>
    <SupervisorLayout>
        <AppHeader title="Dashboard" />
        <AppHeader title="Latest Assigned Jobs" class="font-light" />
        <div class="grid grid-cols-4 gap-appMiddeumSpace">
            <a-card
                v-for="assignedTask in assignedTasks"
                :key="assignedTask.id"
                class="border-2"
                title="Status"
            >
                <template #extra
                    ><h3 class="text-[red]">
                        {{ assignedTask.status }}
                    </h3></template
                >
                <div
                    class="flex justify-between font-bold mb-appMiddeumSpace text-appfirstColor-0"
                >
                    <div
                        class="flex justify-between items-center gap-appSmallSize"
                    >
                        <Icon
                            icon="material-symbols:person"
                            width="20"
                            color="#164863"
                        />
                        <h3>Assigned By</h3>
                    </div>
                    {{ assignedTask.task_assigned_by.user.name }}
                </div>
                <div class="flex justify-between">
                    <div
                        class="flex justify-between items-center gap-appSmallSize"
                    >
                        <Icon icon="fontisto:date" width="20" color="#164863" />
                        <h3>Assigned Date</h3>
                    </div>

                    {{ assignedTask.date }}
                </div>
                <div class="my-appMiddeumSpace">
                    <div
                        class="flex justify-start items-center gap-appSmallSize"
                    >
                        <Icon
                            icon="material-symbols:task-outline"
                            width="25"
                            color="#164863"
                        />
                        <h3 class="font-bold mb-appSmallSize pt-appSmallSize">
                            Task Detail
                        </h3>
                    </div>

                    {{ assignedTask.task }}
                </div>
            </a-card>
        </div>
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({ assignedTasks: Object });

import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import ActionButton from "@/Shared/ActionButton.vue";
import { UIStore } from "@/Stores/UIStore";
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
const uistore = UIStore();
const formState = reactive({
    status: null,
    task_id: null,
});
const changeStatusHandler = (id) => {
    uistore.openModal();
    formState.task_id = id;
};
const onFinish = () => {
    router.patch(route("task.change.status"), formState, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Task Status",
                content: "Successfuly Saved",
                okType: "danger",
            });
        },
    });
};
</script>
