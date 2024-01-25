<template>
    <a-form :model="formState" layout="vertical" @finish="onFinish">
        <a-form-item label="Item Category" name="categoryName">
            <a-input v-model:value="formState.name" class="w-full" />
            <InputError :message="$page.props.errors.name" class="text-[red]" />
        </a-form-item>

        <ActionButton />
    </a-form>
</template>

<script setup>
const emit = defineEmits(["saveHandler"]);

import { reactive } from "vue";
import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";

const formState = reactive({
    name: "",
});
const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
