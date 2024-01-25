<template>
    <a-form :model="formState" @finish="onFinish" layout="vertical">
        <a-form-item
            label="Select Checklist Task"
            name="sub_checklist_id"
            :rules="[
                { required: true, message: 'Checklist Task Field is Required' },
            ]"
        >
            <a-select
                placeholder="Select Checklist Task"
                v-model:value="formState.sub_checklist_id"
            >
                <a-select-option
                    v-for="subChecklist in subChecklists"
                    :key="subChecklist.id"
                    :value="subChecklist.id"
                >
                    {{ subChecklist.name }} ({{
                        subChecklist.main_check_list.name
                    }}
                    Main Checklist)</a-select-option
                >
            </a-select>
            <InputError
                :message="$page.props.errors.sub_checklist_id"
                class="text-[red]"
            />
        </a-form-item>
        <a-form-item
            label="Checklist Task"
            name="task"
            :rules="[
                { required: true, message: 'Checklist Task Field is Required' },
            ]"
        >
            <a-input
                placeholder="Enter Checklist Task"
                v-model:value="formState.task"
            />
            <InputError :message="$page.props.errors.task" class="text-[red]" />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
const props = defineProps({
    subChecklists: Array,
});
console.log(props.subChecklists);
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
import InputError from "@/Components/InputError.vue";
const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    task: null,
    sub_checklist_id: null,
});
const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
