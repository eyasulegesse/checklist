<template>
    <a-form layout="vertical" :model="formState" @finish="onFinish">
        <a-form-item
            label="Report Type"
            name="report_title"
            :rules="[
                {
                    required: true,
                    message: 'Report Title Field is Required',
                },
            ]"
        >
            <a-select
                placeholder="Select Report Type"
                v-model:value="formState.report_title"
            >
                <a-select-option
                    v-for="reportType in reportTypes"
                    :key="reportType.id"
                    :value="reportType.name"
                    >{{ reportType.name }}</a-select-option
                >
            </a-select>
            <InputError
                :message="$page.props.errors.report_title"
                class="text-[red]"
            />
        </a-form-item>
        <a-form-item
            label="Send To"
            name="send_to"
            :rules="[
                {
                    required: true,
                    message: 'Select a person you want to send the Report',
                },
            ]"
        >
            <a-select placeholder="Send to" v-model:value="formState.send_to">
                <a-select-option
                    v-for="user in userLists"
                    :key="user.id"
                    :value="user.id"
                    >{{ user.name }}
                </a-select-option>
            </a-select>
            <InputError
                :message="$page.props.errors.send_to"
                class="text-[red]"
            />
        </a-form-item>

        <a-form-item
            label="Report Detail"
            name="report_detail"
            :rules="[
                { required: true, message: 'Report Detail Field is required' },
            ]"
        >
            <QuillEditor
                toolbar="full"
                theme="snow"
                v-model:content="formState.report_detail"
                contentType="html"
                class="h-[500px]"
                :modules="modules"
            />
            <InputError
                :message="$page.props.errors.report_detail"
                class="text-[red]"
            />
        </a-form-item>
        <ActionButton />
    </a-form>
</template>

<script setup>
defineProps(["reportTypes", "userLists"]);
const emit = defineEmits(["saeHandler"]);
import BlotFormatter from "quill-blot-formatter";
import ActionButton from "@/Shared/ActionButton.vue";
import { reactive } from "vue";
import InputError from "@/Components/InputError.vue";
const formState = reactive({
    send_to: null,
    report_title: null,
    report_detail: null,
});
const modules = {
    name: "blotFormatter",
    module: BlotFormatter,
    options: {
        /* options */
    },
};
const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;
    emit("saveHandler", formState);
    console.log(formState);
};
</script>
