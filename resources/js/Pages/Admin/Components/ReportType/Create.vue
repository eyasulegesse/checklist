<template>
    <a-form :model="formState" @finish="onFinish" layout="vertical">
        <a-form-item label="Select Department">
            <a-select
                placeholder="Select Department"
                v-model:value="formState.department_id"
            >
                <a-select-option
                    v-for="department in departments"
                    :key="department.id"
                    :value="department.id"
                >
                    {{ department.name }}</a-select-option
                >
            </a-select>
        </a-form-item>
        <a-form-item>
            <a-input
                placeholder="Enter Report Type Name"
                v-model:value="formState.name"
            />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
defineProps({
    departments: Array,
});
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    name: null,
    department_id: null,
});
const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
