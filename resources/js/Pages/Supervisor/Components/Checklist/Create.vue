<template>
    <SupervisorLayout>
        <AppHeader title="Add New Checklist" />
        <a-form :model="formState" layout="vertical" @finish="Onfinish">
            <div
                class="grid grid-cols-2 gap-appMiddeumSpace mb-appMiddeumSpace"
            >
                <a-form-item
                    label="Branch"
                    name="branch_id"
                    :rules="[
                        {
                            required: true,
                            message: 'Branch Name Field is required',
                        },
                    ]"
                >
                    <a-select
                        placeholder="Select Branch"
                        @change="onBranchChangeHandler"
                        v-model:value="formState.branch_id"
                    >
                        <a-select-option
                            v-for="branch in branches"
                            :key="branch.id"
                            :value="branch.id"
                            >{{ branch.name }}</a-select-option
                        >
                    </a-select>
                    <InputError
                        :message="$page.props.errors.branch_id"
                        class="text-[red]"
                    />
                </a-form-item>

                <a-form-item
                    label="Department"
                    name="department_id"
                    :rules="[
                        {
                            required: true,
                            message: 'Department Name Field is required',
                        },
                    ]"
                >
                    <a-select
                        placeholder="Select Department"
                        v-model:value="formState.department_id"
                    >
                        <a-select-option
                            v-for="department in selectedDepartment"
                            :key="department.id"
                            :value="department.id"
                            >{{ department.name }}</a-select-option
                        >
                    </a-select>
                    <InputError
                        :message="$page.props.errors.department_id"
                        class="text-[red]"
                    />
                </a-form-item>
            </div>

            <div
                class="grid grid-cols-2 gap-appMiddeumSpace mb-appMiddeumSpace"
            >
                <a-form-item
                    label="Select Main Checklist"
                    name="main_check_list_id"
                    :rules="[
                        {
                            required: true,
                            message: 'Department Name Field is required',
                        },
                    ]"
                >
                    <a-select
                        placeholder="Select Main Checklist"
                        @change="mainChecklistChangeHandler"
                        v-model:value="formState.main_check_list_id"
                    >
                        <a-select-option
                            v-for="mainCheckList in mainCheckLists"
                            :key="mainCheckList.id"
                            :value="mainCheckList.id"
                            >{{ mainCheckList.name }}</a-select-option
                        >
                    </a-select>
                    <InputError
                        :message="$page.props.errors.main_check_list_id"
                        class="text-[red]"
                    />
                </a-form-item>

                <a-form-item
                    label="Sub Checklist"
                    name="sub_checklist_id"
                    :rules="[
                        {
                            required: true,
                            message: 'Sub Checklist Name Field is required',
                        },
                    ]"
                >
                    <a-select
                        placeholder="Select Sub Checklist"
                        @change="subChecklistChangeHandler"
                        v-model:value="formState.sub_checklist_id"
                    >
                        <a-select-option
                            v-for="subChecklist in selectedSubChecklist"
                            :key="subChecklist.id"
                            :value="subChecklist.id"
                            >{{ subChecklist.name }}</a-select-option
                        >
                    </a-select>
                    <InputError
                        :message="$page.props.errors.sub_checklist_id"
                        class="text-[red]"
                    />
                </a-form-item>
            </div>

            <div
                class="shadow-2xl py-appBigSpace pl-appBigSpace mb-appBigSpace"
            >
                <AppHeader title="Task Lists" />
                <a-form-item
                    label="Tasks"
                    name="task"
                    :rules="[
                        {
                            required: true,
                            message:
                                'at least Select One TaskTask Field is required',
                        },
                    ]"
                >
                    <a-checkbox-group v-model:value="formState.task">
                        <div class="grid grid-cols-4 gap-appBigSpace">
                            <div
                                v-for="task in selectedSubChecklistTask"
                                :key="task.id"
                                class="flex flex-col"
                            >
                                <a-checkbox :value="task.id">
                                    {{ task.task }}
                                </a-checkbox>
                            </div>
                        </div>
                    </a-checkbox-group>
                </a-form-item>
            </div>
            <ActionButton />
        </a-form>
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({
    branches: Array,
    departments: Array,
    mainCheckLists: Array,
    subChecklist: Array,
    checklistTask: Array,
});
import InputError from "@/Components/InputError.vue";
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";

const selectedDepartment = ref(null);
const selectedSubChecklist = ref(null);
const selectedSubChecklistTask = ref(null);
const formState = reactive({
    branch_id: null,
    date: null,
    department_id: null,
    main_check_list_id: null,
    sub_checklist_id: null,
    task: [],
});
const onBranchChangeHandler = (branch_id) => {
    selectedDepartment.value = props.departments.filter(
        (department) => department.branch_id === branch_id
    );
};

const mainChecklistChangeHandler = (branch_id) => {
    selectedSubChecklist.value = props.subChecklist.filter(
        (main) => main.main_check_list_id === branch_id
    );
};
const subChecklistChangeHandler = (sub_checkist_id) => {
    selectedSubChecklistTask.value = props.checklistTask.filter(
        (task) => task.sub_checklist_id === sub_checkist_id
    );
};
const Onfinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;
    router.post("/supervisor_checklist_store", formState, {
        onSuccess: () => {
            Modal.success({
                title: "Checklist",
                content: "Successfuly Saved",
                okType: "default",
            });
        },
        onError: (error) => {
            console.log(error);
            Modal.error({
                title: "Error",
                content: error,
                okType: "danger",
            });
        },
    });
    console.log(formState);
};
</script>
