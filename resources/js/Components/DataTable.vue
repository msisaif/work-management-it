<template>

    <div class="w-full flex flex-col sm:flex-row justify-center gap-1">
        <div class="w-full flex flex-col sm:flex-row justify-center gap-1">
            <div class="flex" v-for="(filter, key) in filters" :key="key">
                <select @change="searchHandler" v-model="filterData[key]" :name="key" class="block w-full rounded-md shadow-sm focus:outline-none focus:ring-0">
                    <option value="" selected>
                        {{ key.replaceAll('_', ' ').toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        }) }} (All)
                    </option>
                    <option v-for="(property, index) in filter" :key="index" :value="index">{{ property }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="w-full flex flex-wrap gap-2 justify-between py-2">
        <div class="sm:w-24 flex order-2 lg:order-1">
            <select @change="searchHandler" v-model="perpage" class="block w-full rounded-md shadow-sm focus:outline-none focus:ring-0 cursor-pointer">
                <option value="100">100</option>
                <option value="50">50</option>
                <option value="25">25</option>
                <option value="15">15</option>
            </select>
        </div>

        <div class="w-full lg:max-w-xl lg:w-auto flex order-1 lg:order-2 flex-col sm:flex-row justify-between items-end gap-2">
            <div class="w-full max-w-sm flex justify-end items-center gap-1" v-if="dateFilter">
                <label class="w-12 text-right">From</label>
                <input @input="searchHandler" v-model="dateFrom" :max="this.dateTo" type="date" class="block w-full max-w-xs rounded-md shadow-sm focus:outline-none focus:ring-0" />
            </div>
            <div class="w-full max-w-sm flex justify-end items-center gap-1" v-if="dateFilter">
                <label class="w-12 text-right">To</label>
                <input @input="searchHandler" v-model="dateTo" :min="this.dateFrom" type="date" class="block w-full max-w-xs rounded-md shadow-sm focus:outline-none focus:ring-0" />
            </div>
        </div>

        <div class="w-2/3 max-w-xs lg:w-auto flex order-3 lg:order-3">
            <input @input="searchHandler" class="block w-full rounded-md shadow-sm focus:outline-none focus:ring-0" type="search" v-model="search" placeholder="Search here ..." />
        </div>
    </div>

    <div v-if="collections.meta.total && topLinks" class="w-full p-1">
        <PaginatorLinks :collections="collections" />
    </div>

    <div class="overflow-auto relative">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-blue-600 text-white uppercase text-sm leading-normal">
                    <th v-if="serialColumn" class="py-3 px-2 text-left sticky left-0 bg-blue-600">SL</th>

                    <slot name="head" />
                </tr>
            </thead>

            <tbody class="text-gray-600 text-sm font-light bg-white">

                <tr v-for="(item, index) in collections.data" :key="item.id" class="border-b border-gray-200 hover:bg-gray-50">
                    <td v-if="serialColumn" class="py-3 px-2 text-left sticky left-0 bg-white">
                        {{ collections.meta.from + index }}
                    </td>

                    <slot :item="item" />
                </tr>

                <tr v-if="! collections.meta.total" class="border-b border-gray-200 hover:bg-gray-50">
                    <td colspan="100" class="py-3 px-2 text-center text-red-500">
                        No data found !!
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-if="collections.meta.total && bottomLinks" class="w-full p-1">
        <PaginatorLinks :collections="collections" />
    </div>

</template>

<script>
import Label from './Label.vue';
import PaginatorLinks from './PaginatorLinks.vue';
import { usePage } from '@inertiajs/inertia-vue3'
export default {
    components: { 
        PaginatorLinks,
        Label,
    },
    computed:{
		request() {
			return usePage().props.value.request;
		}
	},
    props: {
        collections: { type: Object, default: {} },
        filters: { type: Object, default: {} },
        dateFilter: { type: Boolean, default: false },
        serialColumn: { type: Boolean, default: true},
        routeName: { type: String, default: null},
        topLinks: { type: Boolean, default: false},
        bottomLinks: { type: Boolean, default: true},
    },
    created() {
        Object.entries(this.filters).forEach( ([key, value]) => {
            this.filterData[key] = this.request[key] || ''
        });

        this.dateFrom = this.request.from || '';

        this.dateTo = this.request.to || '';
    },
    data() {
        return {
            perpage: this.collections.meta.per_page,
            search: '',
            filterData: {},
            data: {},
            dateFrom: '',
            dateTo: '',
        }
    },
    methods: {
        searchHandler() {
            this.data['perpage'] = this.perpage;

            Object.entries(this.filterData).forEach( ([key, value]) => {
                this.data[key] = value;
            });

            this.data['from'] = this.dateFrom;

            this.data['to'] = this.dateTo;

            this.data['sort_by'] = this.sortBy;

            this.$inertia.get(this.route((this.routeName || this.route().current()), this.clean(this.data)), {}, { preserveState: true })
        },
        clean(obj) {
            for (var propName in obj) {
                if (obj[propName] === '' || obj[propName] === null || obj[propName] === undefined) {
                    delete obj[propName];
                }
            }
            return obj;
        },
    }
}
</script>
