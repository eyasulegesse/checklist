<template>
    <a-form ref="user" :model="formState" layout="vertical" @finish="onFinish">
        <div class="grid grid-cols-2 gap-appSmallSize">
            <a-form-item label="Name">
                <a-input
                    placeholder="Enter Name"
                    v-model:value="formState.name"
                />
            </a-form-item>
            <a-form-item label="Email">
                <a-input
                    placeholder="Enter Email"
                    v-model:value="formState.email"
                />
            </a-form-item>
        </div>
        <div class="grid grid-cols-2 gap-appSmallSize">
            <a-form-item label="Select Branch">
                <a-select
                    placeholder="Select branch"
                    v-model:value="formState.branch"
                    @change="changeBranchHandler"
                >
                    <a-select-option
                        v-for="branch in branches"
                        :value="branch.id"
                        :key="branch.id"
                        >{{ branch.name }}</a-select-option
                    >
                </a-select>
            </a-form-item>
            <a-form-item label="Select Department">
                <a-select
                    placeholder="Select Department"
                    v-model:value="formState.department"
                >
                    <a-select-option
                        v-for="department in departmentLists"
                        :value="department.id"
                        :key="department.id"
                        >{{ department.name }}</a-select-option
                    >
                </a-select>
            </a-form-item>
        </div>

        <div class="gap-appSmallSize">
            <a-form-item label="Select Sub Checklist">
                <a-select
                    placeholder="Select Sub Checklist"
                    v-model:value="formState.subChecklistId"
                >
                    <a-select-option
                        v-for="subChecklist in subChecklists"
                        :value="subChecklist.id"
                        :key="subChecklist.id"
                        >{{ subChecklist.name }} ({{
                            subChecklist.main_check_list.name
                        }})</a-select-option
                    >
                </a-select>
            </a-form-item>
        </div>

        <div class="grid grid-cols-2 gap-appSmallSize">
            <a-form-item label="Select Role">
                <a-select
                    placeholder="Select Role"
                    v-model:value="formState.role"
                >
                    <a-select-option value="1">Admin</a-select-option>
                    <a-select-option value="0">Supervisor</a-select-option>
                </a-select>
            </a-form-item>
            <a-form-item label="Password">
                <a-input-password
                    placeholder="Enter Password"
                    v-model:value="formState.password"
                />
            </a-form-item>
        </div>

        <ActionButton />
    </a-form>
</template>

<script setup>
const emit = defineEmits(["saveHandler"]);
const props = defineProps({
    branches: Array,
    departments: Array,
    subChecklists: Array,
});
const departmentLists = ref(null);
const formState = reactive({
    name: null,
    email: null,
    role: null,
    password: null,
    department: null,
    branch: null,
    subChecklistId: null,
});
import ActionButton from "@/Shared/ActionButton.vue";
console.log(props.subChecklists.main_check_list);
import { reactive, ref } from "vue";
const onFinish = () => {
    emit("saveHandler", formState);
    user.value.reset();
};
const changeBranchHandler = (value) => {
    console.log(props.branches);
    departmentLists.value = props.departments.filter(
        (department) => department.branch_id === value
    );
};
</script>
