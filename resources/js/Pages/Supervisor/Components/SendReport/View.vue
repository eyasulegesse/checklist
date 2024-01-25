<template>
    <div>
        <QuillEditor
            toolbar="full"
            theme="snow"
            v-model:content="item.report_detail"
            contentType="html"
            class="h-[500px]"
            :modules="modules"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import BlotFormatter from "quill-blot-formatter";
const props = defineProps(["viewItem"]);
let item = ref();
item = props.viewItem;
console.log(item.report_detail);
const modules = {
    name: "blotFormatter",
    module: BlotFormatter,
    options: {
        /* options */
    },
};
</script>
