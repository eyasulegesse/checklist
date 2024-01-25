<template>
    <a-form
        :model="formState"
        @finish="onFinish"
        layout="vertical"
        class="pt-appMiddeumSpace"
    >
        <a-form-item label="Task Assigned To">
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
                {{ users }}
            </a-select>
        </a-form-item>
        <a-form-item label="Task">
            <a-textarea
                :rows="4"
                placeholder="Enter Task Detail"
                v-model:value="formState.task"
            />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
const props = defineProps({ users: Array, userId: Array });
const emit = defineEmits(["saveHandler"]);
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
console.log(props.users);
const formState = reactive({
    date: null,
    task_assigned_to_id: null,
    task_assigned_by_id: props.userId,
    task: null,
});
const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;
    emit("saveHandler", formState);
};
</script>
