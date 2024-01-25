<template>
    <a-form :model="formState" layout="vertical" @finish="onFinish">
        <a-form-item
            class="mb-appMiddeumSpace"
            label="Branch Name"
            name="name"
            :rules="[{ required: true, message: 'Name Field is required' }]"
        >
            <a-input placeholder="Branch Name" v-model:value="formState.name" />
            <InputError :message="$page.props.errors.name" class="text-[red]" />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
import { reactive } from "vue";

import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";

const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    name: null,
});
const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
