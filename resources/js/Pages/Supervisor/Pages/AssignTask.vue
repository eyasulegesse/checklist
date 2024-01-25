<template>
    <SupervisorLayout>
        <AppHeader title="Assign Task" />
        <AddNewButton title="Assign Task" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Assign Task"
        >
            <Create
                :users="users"
                :user_id="user_id"
                @saveHandler="saveHandler"
            />
        </a-modal>
        <a-modal
            v-model:open="viewAssignTask"
            footer=""
            title="Assign Task Detail"
        >
            <div
                class="flex justify-between mb-appSmallSize mt-appMiddeumSpace"
            >
                <div class="flex justify-between items-center gap-appSmallSize">
                    <Icon
                        icon="material-symbols:person"
                        width="20"
                        color="#164863"
                    />
                    <h3>Task Assigned By</h3>
                </div>

                <h3>{{ assignTaskItem.task_assigned_by.user.name }}</h3>
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <div class="flex justify-between items-center gap-appSmallSize">
                    <Icon
                        icon="material-symbols:person"
                        width="20"
                        color="#164863"
                    />
                    <h3>Task Assigned To</h3>
                </div>

                <h3>{{ assignTaskItem.task_assigned_to.user.name }}</h3>
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <div class="flex justify-between items-center gap-appSmallSize">
                    <Icon icon="fontisto:date" width="20" color="#164863" />
                    <h3>Assigned Date</h3>
                </div>
                <h3
                    class="bg-appfirstColor-0 px-appSmallSize text-appWhiteColor-0 rounded-lg"
                >
                    {{ assignTaskItem.date }}
                </h3>
            </div>
            <div class="my-appMiddeumSpace">
                <h3 class="font-bold mb-appMiddeumSpace">Task Detail</h3>
                <h3>{{ assignTaskItem.task }}</h3>
            </div>
            <div class="my-appMiddeumSpace flex justify-between">
                <div class="flex justify-between items-center gap-appSmallSize">
                    <Icon icon="fontisto:date" width="20" color="#164863" />
                    <h3>Status</h3>
                </div>
                <h3
                    class="bg-appfirstColor-0 px-appSmallSize text-appWhiteColor-0 rounded-lg"
                >
                    {{ assignTaskItem.status }}
                </h3>
            </div>

            <div>
                <a-card title="Change Task Status">
                    <a-form
                        :model="formState"
                        @finish="onFinish"
                        layout="vertical"
                    >
                        <a-form-item label="Change Status">
                            <a-select
                                placeholder="Change Status"
                                v-model:value="formState.status"
                            >
                                <a-select-option value="Done"
                                    >Done</a-select-option
                                >
                                <a-select-option value="Partialy Done"
                                    >Partialy Done</a-select-option
                                >
                                <a-select-option value="Not Done"
                                    >Not Done</a-select-option
                                >
                            </a-select>
                        </a-form-item>
                        <ActionButton />
                    </a-form>
                </a-card>
            </div>
        </a-modal>
        <List :assignTasks="assignTasks" @viewHandler="viewHandler" />
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({
    assignTasks: Array,
    users: Object,
    user_id: Array,
});
const emit = defineEmits(["viewHandler"]);

import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import ActionButton from "@/Shared/ActionButton.vue";
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import List from "../Components/AssignTask/List.vue";
import Create from "../Components/AssignTask/Create.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
import { reactive, ref } from "vue";
const viewAssignTask = ref(false);
const assignTaskItem = ref(null);
const formState = reactive({
    status: null,
    task_id: null,
});
const uistore = UIStore();

const saveHandler = (formData) => {
    router.post(route("task.supervisor.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Task",
                content: "Successfully Assigned",
                okType: "default",
            });
        },
        onError: (error) => {
            Modal.error({
                title: "Error",
                content: error,
                okType: "danger",
            });
        },
    });
};

const viewHandler = (item) => {
    assignTaskItem.value = item;
    viewAssignTask.value = true;
    formState.task_id = assignTaskItem.value["id"];
};
const onFinish = () => {
    router.patch(route("task.change.status"), formState, {
        onSuccess: () => {
            viewAssignTask.value = false;
            Modal.success({
                title: "Task Status",
                content: "Successfuly Changed",
                okType: "danger",
                onOk() {
                    assignTaskItem.value = null;
                },
            });
        },
    });
};
console.log(assignTaskItem.value);
</script>
