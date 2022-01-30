export default {
    fetchAvailableResources(resourceName, fieldAttribute, params) {
        return Nova.request().get(
            `/nova-api/${resourceName}/morphable/${fieldAttribute}`,
            params
        )
    },

    determineIfSoftDeletes(resourceName) {
        return Nova.request().get(`/nova-api/${resourceName}/soft-deletes`)
    },
}
