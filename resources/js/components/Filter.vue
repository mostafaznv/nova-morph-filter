<template>
    <div class="nova-morph-filter">
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

        <div class="p-2">
            <select-control
                v-model="type"
                class="w-full form-control form-select"
                label="display"
                :options="types"
            >
                <option value="" disabled>{{ __('Type') }}</option>
            </select-control>
        </div>

        <div class="p-2">
            <search-input
                @input="performSearch"
                @clear="clearSelection"
                @selected="handleChange"
                :value="value"
                :data="availableResources"
                :clearable="false"
                :disabled="!type"
                trackBy="value"
                searchBy="display"
            >
                <div v-if="value" slot="default" class="flex items-center">
                    <div v-if="value.avatar" class="mr-3">
                        <img :src="value.avatar" class="w-8 h-8 rounded-full block" />
                    </div>

                    <span>{{ value.display }}</span>
                </div>

                <div slot="option" slot-scope="{option, selected}" class="flex items-center">
                    <div v-if="option.avatar" class="mr-3">
                        <img :src="option.avatar" class="w-8 h-8 rounded-full block" />
                    </div>

                    <span>{{ option.display }}</span>
                </div>
            </search-input>
        </div>
    </div>
</template>

<script>
import {PerformsSearches} from "laravel-nova"
import request from '../utils/request'

export default {
    mixins: [
        PerformsSearches
    ],
    props: {
        resourceName: {
            type: String,
            required: true,
        },
        filterKey: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            type: null
        }
    },
    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](
                this.filterKey
            )
        },
        fieldAttribute() {
            return this.filter.fieldAttribute
        },
        value() {
            return this.filter.currentValue
        },
        types() {
            return this.filter.types || []
        }
    },
    watch: {
        type() {
            this.availableResources = []
        }
    },
    methods: {
        getAvailableResources() {
            const params = {
                params: {
                    search: this.search,
                    type: this.type
                },
            }

            return request.fetchAvailableResources(this.resourceName, this.fieldAttribute, params)
                .then(({data: {resources}}) => {
                    this.availableResources = resources
                })
        },
        handleChange(resource) {
            resource.type = this.type
            resource.id = resource.value

            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value: resource
            })

            this.$emit('change')
        },
    }
}
</script>
