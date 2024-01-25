<template>
    <AdminLayout>
        <AppHeader title="Inventory Count Report" />
        <div class="flex gap-appBigSpace">
            <a-button @click="exportToCSV" class="bg-appfirstColor-0"
                ><div class="flex text-appWhiteColor-0 gap-appExtrasmall">
                    <Icon icon="bx:export" color="white" width="20" />
                    <h3>Export CSV</h3>
                </div></a-button
            >
            <a-button
                @click="exportToPDF"
                class="bg-appfirstColor-0 mb-appBigSpace"
                ><div class="flex text-appWhiteColor-0 gap-appExtrasmall">
                    <Icon
                        icon="teenyicons:pdf-outline"
                        color="white"
                        width="20"
                    />
                    <h3>Export to PDF</h3>
                </div></a-button
            >
            <a-form-item label="Filter By Branch">
                <a-select
                    style="width: 250px"
                    placeholder="Select Branch"
                    @change="selectBranchHandler"
                >
                    <a-select-option
                        v-for="branch in branches"
                        :key="branch.id"
                        :value="branch.id"
                        >{{ branch.name }}</a-select-option
                    >
                </a-select>
            </a-form-item>
        </div>
        <div id="printApp" ref="document">
            <div id="element-to-convert">
                <div
                    class="flex justify-between bg-['gray'] border-y-2 border-appfirstColor-0 pb-appBigSpace h-[150px] px-appBigSpace mb-appExtrasmall pt-appExtrasmall"
                >
                    <div>
                        <h3 class="text-appfirstColor-0 font-bold text-[20px]">
                            Leafam Management Group
                        </h3>
                        <h3 class="text-appfirstColor-0 text-[15px]">
                            Inventory Count Report
                        </h3>
                        <h3 class="text-appfirstColor-0 text-[15px]">
                            Tin No : 0039105509
                        </h3>
                    </div>
                    <div
                        class="flex flex-col items-start pb-appExtrasmall pt-appExtrasmall border border-appfirstColor-0 mt-appExtrasmall px-appMiddeumSpace"
                    >
                        <h3 class="text-appfirstColor-0 text-[16px]">
                            Date : {{ currentDate() }}
                        </h3>
                        <h3 class="text-appfirstColor-0 text-[15px]">
                            Telephone :+251 91 123 6353
                        </h3>
                        <h3 class="text-appfirstColor-0 text-[15px]">
                            Email: Leofamtrading@gmail.com
                        </h3>
                    </div>
                </div>
                <table class="ml-appMiddeumSpace mr-appMiddeumSpace">
                    <tr class="text-[14px]">
                        <th>Item Name</th>
                        <th>Item Code</th>
                        <th>Amount</th>
                        <th>Counted By</th>
                        <th>Branch</th>
                        <th>Date</th>
                    </tr>
                    <tr
                        v-for="(body, index) in reportData"
                        :key="index"
                        class="text-[12px]"
                    >
                        <td>{{ body.item }}</td>
                        <td>{{ body.itemCode }}</td>
                        <td>{{ body.amount }}</td>
                        <td>{{ body.user }}</td>
                        <td>{{ body.branch }}</td>
                        <td>{{ body.date }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
const props = defineProps({ inventoryCount: Object, branches: Object });
console.log(props.inventoryCount);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import { router } from "@inertiajs/vue3";
import exportFromJSON from "export-from-json";
import html2pdf from "html2pdf.js";
import { reactive } from "vue";
const reportData = reactive([]);

props.inventoryCount.forEach((item) => {
    reportData.push({
        id: item.id,
        item: item.item.name,
        itemCode: item.item.code,
        amount: item.amount,
        user: item.user.name,
        branch: item.branch.name,
        date: item.date,
    });
});

const selectBranchHandler = (id) => {
    router.get(`/inventory_count_By_branch/${id}`);
};
const currentDate = () => {
    const current = new Date();
    const date = `${current.getDate()}/${
        current.getMonth() + 1
    }/${current.getFullYear()}`;
    return date;
};
const exportToPDF = () => {
    html2pdf(document.getElementById("element-to-convert"), {
        margin: 1,
        filename: "i-was-html.pdf",
    });
};
const exportToCSV = () => {
    if (!props.inventoryCount) return;
    try {
        const fileName = "exported-data";
        const exportType = "csv";
        const data = props.inventoryCount;
        exportFromJSON({ data, fileName, exportType });
    } catch (e) {}
};
</script>
