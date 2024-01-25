<template>
    <a-form :model="formState" @finish="onFinish" layout="vertical">
        <a-form-item
            label="Main Checklist Name"
            name="name"
            class="mb-appMiddeumSpace"
            :rules="[
                {
                    required: true,
                    message: 'Main Checklist Name Field is required',
                },
            ]"
        >
            <a-input
                placeholder="Eneter Main Checklist Name"
                v-model:value="formState.name"
            />
        </a-form-item>

        <ActionButton />
    </a-form>
</template>

<script setup>
defineProps({ mainCheckList: Array });
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    name: null,
    main_check_lists_id: null,
});
const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
