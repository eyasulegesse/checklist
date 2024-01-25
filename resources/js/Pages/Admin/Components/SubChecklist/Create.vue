<template>
    <a-form :model="formState" @finish="onFinish" layout="vertical">
        <a-form-item
            class="mb-appMiddeumSpace"
            label="Select Main Checklist"
            name="main_check_list_id"
            :rules="[
                { required: true, message: 'Main Checklist Field is required' },
            ]"
        >
            <a-select
                placeholder="Select Main Checklist"
                v-model:value="formState.main_check_list_id"
            >
                <a-select-option
                    v-for="mainCheckList in mainCheckList"
                    :key="mainCheckList.id"
                    :value="mainCheckList.id"
                >
                    {{ mainCheckList.name }}</a-select-option
                >
            </a-select>
            <InputError
                :message="$page.props.errors.main_check_list_id"
                class="text-[red]"
            />
        </a-form-item>
        <a-form-item
            label="Sub Checklist Name"
            name="name"
            :rules="[
                { required: true, message: 'Sub Checklist Field is Required' },
            ]"
        >
            <a-input
                placeholder="Enter Sub Checklist Name"
                v-model:value="formState.name"
            />
            <InputError :message="$page.props.errors.name" class="text-[red]" />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
defineProps({
    mainCheckList: Array,
});
import InputError from "@/Components/InputError.vue";
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    name: null,
    main_check_list_id: null,
});
const onFinish = () => {
    console.log(formState);
    emit("saveHandler", formState);
};
</script>
