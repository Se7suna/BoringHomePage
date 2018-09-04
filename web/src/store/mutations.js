import {
    RECEIVE_SAVELIST,
    RECEIVE_ADDITEM,
    LOGOUT
} from './mutation-types.js'
export default {
    [RECEIVE_SAVELIST] (state, list) {
        if (list.resCode === 1) {
            state.saveList = list.resData
        } else {
            console.log('获取列表失败')
        }
    },
    [RECEIVE_ADDITEM] (state, item) {
        if (item.resCode === 1) {
            state.saveList.dataList.push(item.resData)
        }
    },
    [LOGOUT] (state) {
        state.user = {}
    }
}
