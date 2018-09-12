import {
  RECEIVE_USER,
  RECEIVE_SAVELIST,
  RECEIVE_ADDLINK,
  RECEIVE_UPDATEITEM,
  RECEIVE_DELETEITEM,
  RECEIVE_QUITGROUP,
  RECEIVE_NEWGROUP,
  RECEIVE_JOINGROUP,
  RECEIVE_HANDLEPUSH,
  RECEIVE_GETHASH,
  LOGOUT,
} from './mutation-types.js';
export default {
  [RECEIVE_USER](state, user) {
    state.user = user;
  },
  [RECEIVE_SAVELIST](state, resData) {
    state.linkList = [];
    for (let i of resData.dataList) {
      state.linkList.push(i);
    }
  },
  [RECEIVE_ADDLINK](state, item) {
    state.linkList.dataList.push(item);
  },
  [RECEIVE_UPDATEITEM](state, item) {
    for (let i of state.linkList.dataList) {
      if (i.linkId === item.linkId) {
        i.id = item.id;
        i.linkId = item.linkId;
        i.linkIco = item.linkIco;
        i.linkToSrc = item.linkToSrc;
        i.linkName = item.linkName;
        return;
      }
    }
  },
  [RECEIVE_DELETEITEM](state, linkId) {
    const arr = state.linkList.dataList;
    for (let i = 0, len = arr.length; i < len; i++) {
      if (arr[i].linkId === linkId) {
        arr.splice(i, 1);
        return;
      }
    }
  },
  [LOGOUT](state) {
    state.user = {};
  },
  [RECEIVE_QUITGROUP](state, data) {
    state.user.key = data.key;
  },
  [RECEIVE_NEWGROUP](state, data) {
    state.hashList.push(data.groupId);
  },
  [RECEIVE_JOINGROUP](state, data) {
    state.hashList.push(data.groupId);
  },
  [RECEIVE_HANDLEPUSH](state, linkId) {
    const arr = state.user.push;
    for (let i = 0, len = arr.length; i < len; i++) {
      if (arr[i].linkId === linkId) {
        arr.splice(i, 1);
        return;
      }
    }
  },
  [RECEIVE_GETHASH](state, arr) {
    for (let i of arr) {
      state.hashList.push(i.groupId);
    }
  },
};
