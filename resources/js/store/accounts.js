export const account = {
    state:()=>({
        accounts: [],
    }),
    getters:{
        accounts: state => state.accounts,
        accountsByService: (state, getters, rootState) => {
            if (rootState.currentService === 'all') {
                return getters.accounts
            }
            return getters.accounts.filter(account => account.service_id === parseInt(rootState.currentService.id))
        }
    },
    mutations:{
        setAccounts (state, accounts) {
            state.accounts = accounts
        },
        addAccount (state, account) {
            state.accounts.push(account)
        },
        updateAccount (state, account) {
            state.accounts.forEach(item => {
                if(item.id === account.id) {
                    item.login = account.login
                    item.password = account.password
                }
            })
        },
        deleteAccount (state, id) {
            state.accounts = state.accounts.filter(account => account.id !== id);
        }
    },
    actions:{
        async createAccount ({ commit, dispatch }, account) {
            try {
                commit('startLoading')
                const response = await axios.post('/api/accounts', account)
                const data = await response.data
                commit('addAccount', data)
                commit('incrementAccountsCount', data.service_id)
            }catch (e){
                commit('setError', e)
                throw e
            }
        },
        async updateAccount ({ commit }, account) {
            try {
                commit('startLoading')
                const response = await axios.put('/api/accounts/' + account.id, {
                    login: account.login,
                    password: account.password
                });
                const data = await response.data
                commit('updateAccount', data)
            }catch (e){
                commit('setError', e)
                throw e
            }
        },
        async getAccounts ({ commit }) {
            try {
                commit('startLoading')
                const response = await axios.get('/api/accounts')
                const data = await response.data
                commit('setAccounts', data)
            }catch (e){
                commit('setError', e)
                throw e
            }
        },
        async deleteAccount ({ commit }, id) {
            try {
                commit('startLoading')
                const response = await axios.delete('/api/accounts/' + id)
                const data = await response.data
                commit('deleteAccount', parseInt(data.id))
                commit('decrementAccountsCount', parseInt(data.service_id))
            }catch (e){
                commit('setError', e)
                throw e
            }
        }
    }
}
