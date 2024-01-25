<template>
    <a-form layout="vertical" :model="formState" @finish="onFinish">
        <div class="mb-appMiddeumSpace">
            <a-form-item
                label="Select Branch"
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
                    v-model:value="formState.branch_id"
                >
                    <a-select-option
                        v-for="branch in branches"
                        :key="branch.id"
                        :value="branch.id"
                    >
                        {{ branch.name }}
                    </a-select-option>
                    <InputError
                        :message="$page.props.errors.branch_id"
                        class="text-[red]"
                    />
                </a-select>
            </a-form-item>

            <a-form-item
                label="Department Name"
                name="name"
                :rules="[
                    { required: true, message: 'Department Name is Required' },
                ]"
            >
                <a-input
                    placeholder="Enter Department Name"
                    v-model:value="formState.name"
                />
                <InputError
                    :message="$page.props.errors.name"
                    class="text-[red]"
                />
            </a-form-item>
        </div>
        <ActionButton />
    </a-form>
</template>

<script setup>
import { reactive } from "vue";
import ActionButton from "@/Shared/ActionButton.vue";
const emit = defineEmits(["saveHandler"]);
import InputError from "@/Components/InputError.vue";
defineProps(["branches"]);
const formState = reactive({
    name: null,
    branch_id: null,
});

const onFinish = () => {
    emit("saveHandler", formState);
};
</script>
