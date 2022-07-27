import {
    createStore
} from 'vuex'

const store = createStore({
    state() {
        return {
            routes: {}
        }
    },
    mutations: {
        isValidated(state) {
            return state.user && state.user.validated_at
        },
    }
})
export default store;