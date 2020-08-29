export const service ={
    state:()=>({
        services: [],
    }),
    getters:{
        services: state => state.services,
    },
    mutations:{
        setServices (state, services) {
            state.services = services
        },
        addService (state, service) {
            state.services.push(service)
        },
        updateService (state, service) {
            state.services.find(item => item.id === service.id).name = service.name
        },
        deleteService (state, serviceId) {
            state.services = state.services.filter(service => service.id !== serviceId)
        },
        incrementAccountsCount (state, serviceId) {
            state.services.find(item => item.id === serviceId).accounts_count++
        },
        decrementAccountsCount(state, serviceId) {
            state.services.find(item => item.id === serviceId).accounts_count--
        }
    },
    actions: {
        async getServices ({ commit }) {
            try {
                const response = await axios.get('/api/services')
                const data = await response.data
                commit('setServices', data)
            }catch (e){
                commit('setError', e)
            }
        },
        async createService ({ commit }, service) {
            try {
                const response = await axios.post('/api/services', service)
                const data = await response.data
                commit('addService', data)
            } catch (e){
                commit('setError', e)
            }
        },
        async updateService({ commit }, service){
            try{
                const response = await axios.put('/api/services/' + service.id, { name : service.name })
                const data = await response.data
                commit('updateService', data)
            }catch (e){
                commit('setError', e)
            }
        },
        async deleteService ({ commit, dispatch }, serviceId) {
            try {
                const response = await axios.delete('/api/services/' + serviceId)
                const data = await response.data
                commit('deleteService', data.id)
                commit('setCurrentService', 'all')
                dispatch('getAccounts')
            } catch (e){
                commit('setError', e)
            }
        },
    }
}
