import {
    RECEIVE_SAVELIST,
    RECEIVE_ADDITEM,
    LOGOUT
} from './mutation-types.js'
import {
    reqSaveList,
    reqAddItem
} from '../api'
export default {
    async getSaveList ({commit}, data) {
        const URL = '/getFavoriteLinks.php'
        const result = await reqSaveList(URL, data)
        commit(RECEIVE_SAVELIST, result)
    },
    async addItem ({commit}, data) {
        const URL = '/updateFavoriteLinks.php'
        const result = await reqAddItem(URL, data)
        commit(RECEIVE_ADDITEM, result)
    },
    logOut ({commit}) {
        window.localStorage.boring = ''
        commit(LOGOUT)
    }
}
