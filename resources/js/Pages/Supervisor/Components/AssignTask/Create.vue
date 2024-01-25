<template>
    <a-form
        :model="formState"
        @finish="onFinish"
        layout="vertical"
        class="pt-appMiddeumSpace"
    >
        <a-form-item
            label="Task Assigned To"
            name="task_assigned_to_id"
            :rules="[
                {
                    required: true,
                    message: 'Select Assigned Person is required',
                },
            ]"
        >
            <a-select
                placeholder="Task Assigned To"
                v-model:value="formState.task_assigned_to_id"
            >
                <a-select-option
                    v-for="user in users"
                    :key="user.id"
                    :value="user.id"
                    >{{ user.name }}</a-select-option
                >
            </a-select>
            <InputError
                :message="$page.props.errors.task_assigned_to_id"
                class="text-[red]"
            />
        </a-form-item>
        <a-form-item
            label="Task"
            name="task"
            :rules="[
                { required: true, message: 'Task Detail Field is required' },
            ]"
        >
            <a-textarea
                :rows="4"
                placeholder="Enter Task Detail"
                v-model:value="formState.task"
            />
            <InputError :message="$page.props.errors.task" class="text-[red]" />
        </a-form-item>

        <ActionButton />
    </a-form>
</template>

<script setup>
const props = defineProps({ users: Object, user_id: Object });
const emit = defineEmits(["saveHandler"]);
import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";
import { reactive } from "vue";
const formState = reactive({
    date: null,
    task_assigned_to_id: null,
    task_assigned_by_id: props.user_id,
    task: null,
});

const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;
    emit("saveHandler", formState);
};
</script>
