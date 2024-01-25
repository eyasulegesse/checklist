<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-appfirstColor-0"
    >
        <div class="flex justify-center items-center">
            <slot name="logo" />
        </div>
        <div
            class="w-full sm:max-w-xl mt-6 px-appBigSpace py-appBigSpace bg-appWhiteColor-0 shadow-md overflow-hidden sm:rounded-3xl"
        >
            <slot />
        </div>
    </div>
</template>
